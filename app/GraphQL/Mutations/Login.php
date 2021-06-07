<?php

namespace App\GraphQL\Mutations;

use App\Models\{User, Category};
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Login extends BaseAuthResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $email = $args['email'];

        $credentials = $this->buildCredentials($args);

        $user = User::select('id', 'name', 'last_name', 'role')->where('email', $email)->first();

        if(!$user) {

            return array_merge(
                [
                    'status' => false,
                    'message' => config('messages.login.error'),
                    'user' => null,
                ]
            );
        }

        $credentials = [
            "username" => $email,
            "password" => "09c06db3f9fc74363453c73619efb25171f1634e",
            "client_id" => config('lighthouse-graphql-passport.client_id'),
            "client_secret" => config('lighthouse-graphql-passport.client_secret'),
            "grant_type" => "password"
        ];


        $request = Request::create('oauth/token', 'POST', $credentials, [], [], [
            'HTTP_Accept' => 'application/json',
        ]);

        $response = app()->handle($request);


        $decodedResponse = json_decode($response->getContent(), true);

        //dd( $decodedResponse['error'] );
        if (array_key_exists('error', $decodedResponse)) {
          return array_merge(
                [
                    'status' => false,
                    'message' => config('messages.login.error'),
                    'user' => null,
                ]
            );
          }


        return array_merge(
            $decodedResponse,
            [
                'message' => config('messages.login.success'),
                'status' => true,
                'user' => $user,
            ]
        );
    }

    protected function validateUser($user)
    {
        $authModelClass = $this->getAuthModelClass();
        if ($user instanceof $authModelClass && $user->exists) {
            return;
        }

        throw (new ModelNotFoundException())->setModel(
            get_class($this->makeAuthModelInstance())
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

    protected function findUser(string $username)
    {
        $model = $this->makeAuthModelInstance();

        if (method_exists($model, 'findForPassport')) {
            return $model->findForPassport($username);
        }

        return $model->where(config('lighthouse-graphql-passport.username'), $username)->first();
    }

}
