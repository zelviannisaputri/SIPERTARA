<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:users'],
            'tempat' => ['required', 'string', 'max:255'],
            'tanggallahir' => ['required', 'date'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'nik' => $input['nik'],
            'tempat' => $input['tempat'],
            'tanggallahir' => $input['tanggallahir'],
            'pekerjaan' => $input['pekerjaan'],
            'alamat' => $input['alamat'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'is_approved' => false,
        ]);
    }
}
