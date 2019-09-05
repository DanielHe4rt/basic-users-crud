<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserValidation;


class UserController extends Controller {

    private $model;

    public function __construct(User $user) {
        $this->model = $user;
    }

    public function getUsers() {

        try {
            $users = $this->model->all();
            if (count($users) > 0){
                return response()->json($users, Response::HTTP_OK);
            } else {
                return response()->json([], Response::HTTP_OK);
            }
        } catch (QueryException $exception){
            return response()->json(['error' => 'Deu merda no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getUser(int $id) {
        try {
            $user = $this->model->find($id);
            if (count($user) > 0){
                return response()->json($user, Response::HTTP_OK);
            } else {
                return response()->json([], Response::HTTP_OK);
            }
        } catch (QueryException $exception){
            return response()->json(['error' => 'Deu merda no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function addUser(Request $request) {

        $validator = Validator::make(
            $request->all(),
            UserValidation::VALIDATION_RULES
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $hashed = hash("md5", $request->pass_hash);
                $request->merge(['pass_hash' => $hashed]);
                $user = $this->model->create($request->all());
                return response()->json($user, Response::HTTP_CREATED);
            } catch (QueryException $exception){
                return response()->json(['error' => 'Deu merda no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }



    }

    public function deleteUser(int $id) {

        try {
            $user = $this->model->find($id)
                ->delete();
            return response()->json([null], Response::HTTP_OK);
        } catch (QueryException $exception){
            return response()->json(['error' => 'Deu merda no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function updateUser(int $id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            UserValidation::VALIDATION_RULES
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $hashed = hash("md5", $request->pass_hash);
                $request->merge(['pass_hash' => $hashed]);
                $user = $this->model->find($id)
                    ->update($request->all());
                return response()->json($user, Response::HTTP_OK);
            } catch (QueryException $exception) {
                return response()->json(['error' => 'Deu merda no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
