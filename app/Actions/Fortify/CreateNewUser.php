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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);


        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:100'],
        //     'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
        //     'apellido' => ['required', 'string', 'max:100'],
        //     'edad' => ['required', 'int', 'max:110', 'min:1'],
        //     'dni' => ['required','digits:8','numeric', 'unique:profiles'],
        //     'fecha_nac' => ['required'],
        //     'sexo' => ['required'],
        //     'password' => $this->passwordRules(),
        //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        // ])->validate();


        // Profile::create([
        //     'nombre' => $user->name,
        //     'apellido' => $input['apellido'],
        //     'edad' => $input['edad'],
        //     'dni' => $input['dni'],
        //     'fecha_nac' => $input['fecha_nac'],
        //     'sexo' => $input['sexo'],
        //     'user_id' => $user->id,
        // ]);
    }
}
