<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidarCredenciales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(env('GITHUB_USER') == '' && env('GITHUB_TOKEN') == '')
            return redirect('error-credenciales');
        return $next($request);
    }
}
