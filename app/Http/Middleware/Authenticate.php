<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        //Saber si la redireccion es de una ruta que comienza con el nombre admin
        /* if (str_starts_with($request->path(), 'admin')) {
            return route('admin.login');
        } */

        return $request->expectsJson() ? null : route('login');
    }
}
