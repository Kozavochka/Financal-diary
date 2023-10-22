<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AdminApiMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $jwtAuth = JWTAuth::parseToken();//Получение токена

        //Проверка blacklist
        if ($jwtAuth->blacklist()->has($jwtAuth->payload())) {
            throw new TokenBlacklistedException();
        }

        $user = $jwtAuth->authenticate();
        if ($user && $user->role !== 'admin') {
            return response()->json(['error' => 'Вы не админ'], 401);
        }

        return $next($request);
    }
}
