<?php
namespace App\Providers;

use App\Models\JwtUser;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class JwtUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // No-op for stateless JWT
    }

    public function retrieveByCredentials(array $credentials)
    {
        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return false;
    }

    // --- Metode Kustom untuk Memuat Pengguna dari Payload JWT ---
    public function retrieveByPayload($payload)
    {
        // Buat instance JwtUser dari payload yang sudah didecode
        return new JwtUser($payload);
    }

    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
        // No-op for stateless JWT
    }
}
