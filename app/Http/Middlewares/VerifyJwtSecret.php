<?php

namespace App\Http\Middlewares;

use App\Models\JwtUser;
use Closure;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class VerifyJwtSecret
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $jwt = $matches[1];
        $tokenParts = explode('.', $jwt);

        if (count($tokenParts) !== 3) {
            return response()->json(['error' => 'Invalid JWT format'], 401);
        }

        $headerPart = $tokenParts[0];
        $payloadPart = $tokenParts[1];

        try {
            $decodedHeader = json_decode(base64_decode(strtr($headerPart, '-_', '+/')), false);
            $decodedPayload = json_decode(base64_decode(strtr($payloadPart, '-_', '+/')), false);

            // --- Mulai Verifikasi Masa Berlaku Token ---
            $currentTime = time(); // Waktu saat ini dalam Unix timestamp

            // 1. Verifikasi 'iat' (Issued At Time)
            // Token tidak boleh digunakan sebelum waktu pembuatannya
            if (isset($decodedPayload->iat) && $currentTime < $decodedPayload->iat) {
                return response()->json(['error' => 'Token cannot be used before issued time'], 401);
            }

            // 2. Verifikasi 'exp' (Expiration Time)
            // Token tidak boleh digunakan setelah waktu kedaluwarsa
            if (isset($decodedPayload->exp) && $currentTime > $decodedPayload->exp) {
                return response()->json(['error' => 'Token has expired'], 401);
            }
            // --- Akhir Verifikasi Masa Berlaku Token ---

            // TODO::Next need to verify (Ini adalah pengingat untuk verifikasi SIGNATURE!)
            // Ingat, tanpa verifikasi SIGNATURE, token ini masih bisa dipalsukan.
            // Klaim exp dan iat yang Anda periksa di sini bisa saja dipalsukan.
            $request->attributes->add([
                'jwt_header' => $decodedHeader,
                'jwt_payload' => $decodedPayload
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Error decoding or validating token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
