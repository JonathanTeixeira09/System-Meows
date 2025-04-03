<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InjectProfissionalData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next)
     {
         if (Auth::check()) {
             $user = Auth::user()->load('profissional');

             view()->share([
                 'currentProfissional' => [
                     'id' => $user->profissional->id ?? null,
                     'nome' => $user->profissional->nome ?? $user->name,
                     'thumbnail' => isset($user->profissional->thumbnail)
                         ? asset('storage/'.$user->profissional->thumbnail)
                         : asset('images/default-avatar.jpg')
                 ]
             ]);
         }

         return $next($request);
     }
}
