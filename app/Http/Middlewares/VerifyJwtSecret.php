<?php

namespace App\Http\Middlewares;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class VerifyJwtSecret
{
    private $secret = 'q1w2e3r4t5y6u7i8o9p0asdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@#'; // samain dengan secret Spring kamu

    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $jwt = $matches[1];

        try {
            // Decode & verify HS256 JWT dengan secret key
            $decoded = JWT::decode($jwt, new Key($this->secret, 'RS256'));

            // Tambahkan klaim ke request agar bisa dipakai controller
            $request->attributes->add(['jwt_payload' => $decoded]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
