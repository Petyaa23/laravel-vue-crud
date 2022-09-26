<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{


public function handle(Request $request, Closure $next)
{
if (Auth::user()->role != User::DEFAULT_USER) {


    return $next($request);
}
    abort(404);
}
}
