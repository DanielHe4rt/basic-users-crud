<?php


namespace App\Validators\Auth;


class UserValidation
{
    const VALIDATION_RULES = [
        'name' => 'required | min:2 | max:50',
        'email' => 'required | min:6 | max:30',
        'pass_hash' => 'required | min:8'
    ];
}
