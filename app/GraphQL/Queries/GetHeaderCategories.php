<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;
use App\Models\{User, Category};

class GetHeaderCategories
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {   
        $id = Auth::guard('api')->user()->id;
        $role = Auth::guard('api')->user()->role;

        if($role === 2) {
            $c = Category::select('id', 'title', 'slug')->get();
            return $c;
        }

        $u = User::find($id);
        return collect([$u->category]);

    }
}
