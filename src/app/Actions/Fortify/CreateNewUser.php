<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{

    public function create(array $input)
    {
        abort(500, 'CREATE HIT');

        Validator::make(
            $input,
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'name.required' => '名前は必須です。',
                'email.required' => 'メールアドレスは必須です。',
                'email.email' => '正しいメールアドレス形式で入力してください。',
                'password.required' => 'パスワードは必須です。',
            ]
        )->validate(); // ← これが最重要

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
