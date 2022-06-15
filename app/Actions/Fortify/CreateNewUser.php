<?php

namespace App\Actions\Fortify;

use App\Models\Aplicant;
use App\Models\Profile;
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
            'nombre' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'date_nac' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required'],
            'address' => ['required', 'max:255'],
            'phone' => ['required', 'digits:9', 'numeric', 'unique:profiles'],
            'document_number' => ['required','numeric', 'unique:profiles'],
            'type_document_id' => ['required','numeric'],
            'district_id' => ['required','numeric'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',

        ])->validate();

        $user = User::create([
            'name' => $input['nombre'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole("solicitante");

        Profile::create([
            'name' => $user->name,
            'lastname' => $input['lastname'],
            'date_nac' => $input['date_nac'],
            'gender' => $input['gender'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'document_number' => $input['document_number'],
            'type_document_id' => $input['type_document_id'],
            'district_id' => $input['district_id'],
            'user_id' => $user->id],
        );

        Aplicant::create([
            "user_id"=>$user->id
        ]);


        return $user;

    }
}
