<?php

namespace App\GraphQL\Queries;

use App\Models\User;

class GetUserDataByEmail
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $email = $args['email'];

        $user = User::select('id', 'email', 'name', 'last_name', 'second_last_name', 'delegation_name',
                                'office_phone', 'extension', 'cellphone', 'institutional_email',
                                'rfc', 'position', 'medical_unity_name', 'department', 'employee_number', 'orders')
            ->where('email', $email)
            ->first();

        return $user;
    }
}
