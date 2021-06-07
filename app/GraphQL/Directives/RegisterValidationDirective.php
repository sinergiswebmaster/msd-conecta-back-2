<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;


class RegisterValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'last_name' => ["required"],
            'email' => ["required", "email", 'confirmed', "unique:users,email"],

            'profession_id' => ['required'],
            'specialty_id' => ['required'],

            'license' => ['required'],
            'phone' => ['required'],

            'agree_terms' => ["accepted"],
            'agree_privacy' => ["accepted"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => config('messages.name.required'),
            'last_name.required' => config('messages.last_name.required'),
           
            'email.required' => config('messages.email.required'),
            'email.email' => config('messages.email.email'),
            'email.confirmed' => config('messages.email.confirmed'),
            'email.unique' => config('messages.email.unique'),
            // 'password.required' =>  config('messages.password.required'),
            // 'password.confirmed' =>  config('messages.password.confirmed'),
            // 'password.min' =>  config('messages.password.min'),

            'profession_id.required' => config('messages.profession_id.required'),
            'specialty_id.required' => config('messages.specialty_id.required'),

            'license.required' => config('messages.license.required'),
            'phone.required' => config('messages.phone.required'),

            'agree_terms.accepted' => config('messages.agree_terms.accepted'),
            'agree_privacy.accepted' => config('messages.agree_privacy.accepted'),
        ];
    }

}