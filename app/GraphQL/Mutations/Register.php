<?php

namespace App\GraphQL\Mutations;

//use Illuminate\Auth\Events\Registered;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\{User};
use Carbon\Carbon;
use App\Notifications\RegisterConfirmed;


class Register extends BaseAuthResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($rootValue, array $args)
    {
        $model = app(config('auth.providers.users.model'));

        $input = collect($args)->except(['email_confirmation', 'agree'])->toArray();
        //$password = $input['password'];
        //$input['password'] = Hash::make($input['password']);
        $input['email'] = strtolower($input['email']);
        $input['role'] = 0;


        $model->fill($input);
        $model->save();


        $credentials = [
            "username" => $input['email'] ,
            "password" => '09c06db3f9fc74363453c73619efb25171f1634e',
            "client_id" => config('lighthouse-graphql-passport.client_id'),
            "client_secret" => config('lighthouse-graphql-passport.client_secret'),
            "grant_type" => "password"
        ];

        $request = Request::create('oauth/token', 'POST', $credentials, [], [], [
            'HTTP_Accept' => 'application/json',
        ]);

        $response = app()->handle($request);

        $decodedResponse = json_decode($response->getContent(), true);

        //$this->validateUser($user);
        $user = User::select('id', 'email', 'name', 'last_name', 'role')->where('email', $input['email'] )->first();
        $user->notify(new RegisterConfirmed() );

        return array_merge(
            $decodedResponse,
            [
                'message' => config('messages.register.success'),
                'status' => true,
                'user' => $user,
            ]
        );
    }


    protected function getAuthModelClass(): string
    {
        return config('auth.providers.users.model');
    }

    protected function makeAuthModelInstance()
    {
        $modelClass = $this->getAuthModelClass();

        return new $modelClass();
    }

}
