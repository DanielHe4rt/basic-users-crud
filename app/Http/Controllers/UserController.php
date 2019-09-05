<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Validators\Auth\UserValidation;


class UserController extends Controller
{

    private $model;


    public $limit = 15;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUsers()
    {
        return response()->json($this->model->paginate($this->limit), Response::HTTP_OK);
    }

    public function getUser(int $id)
    {
        return response()->json($this->model->findOrFail($id));
    }

    public function addUser(Request $request)
    {
        $this->validate($request, UserValidation::VALIDATION_RULES);
        $hashed = Hash::make($request->input('password'));
        $request->merge(['password' => $hashed]);
        $user = $this->model->create($request->all());
        return response()->json($user, Response::HTTP_CREATED);
    }

    public function deleteUser(int $id)
    {
        $this->model->findOrFail($id)->delete();
        return response()->json([]);
    }

    public function updateUser(int $id, Request $request)
    {
        // Pense numa melhor forma de fazer seu validador de update, pois nem sempre o usuário irá mandar todas as informações.
        $this->validate($request,UserValidation::VALIDATION_RULES);

        // Siga o modelo do addUser pra completar essa parte.

    }
}
