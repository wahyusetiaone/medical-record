<?php
namespace App\Auth\Guards;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class JwtGuard implements Guard
{
    use GuardHelpers;

    protected $provider;
    protected $request;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {

        // Jika user sudah di-resolve, kembalikan saja
        if (! is_null($this->user)) {
            return $this->user;
        }

        // Ambil payload JWT dari atribut request yang sudah ditambahkan oleh middleware
        $payload = $this->request->attributes->get('jwt_payload');

        if (! is_null($payload)) {
            // Gunakan user provider untuk membuat user dari payload
            $this->user = $this->provider->retrieveByPayload($payload);
        }

        return $this->user;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        // Validasi sudah dilakukan oleh middleware JWT, jadi metode ini tidak digunakan
        // untuk proses autentikasi JWT.
        return false;
    }

    // Metode lain dari Guard interface (login, logout, dsb.) bisa diimplementasikan
    // sesuai kebutuhan, tapi seringkali tidak relevan untuk JWT stateless.
}
