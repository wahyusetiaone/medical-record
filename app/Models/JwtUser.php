<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;

class JwtUser implements Authenticatable
{
    private $payload;

    /**
     * Create a new JwtUser instance.
     *
     * @param object $payload The decoded JWT payload as a stdClass object.
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'sub';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->payload->sub;
    }

    /**
     * Get the password for the user.
     * Not used for JWT authentication as it's stateless and token-based.
     *
     * @return string|null
     */
    public function getAuthPassword()
    {
        return null;
    }

    /**
     * Get the "remember me" token value.
     * Not used for JWT authentication.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return null;
    }

    /**
     * Set the "remember me" token value.
     * Not used for JWT authentication.
     *
     * @param string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Not used for JWT
    }

    /**
     * Get the name of the "remember me" token.
     * Not used for JWT authentication.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * Get a property from the JWT payload.
     * This allows accessing payload properties directly like $user->email.
     *
     * @param string $key
     * @return mixed|null
     */
    public function __get($key)
    {
        if (property_exists($this->payload, $key)) {
            return $this->payload->{$key};
        }
        return null;
    }

    /**
     * Get the roles from the account data in the JWT payload.
     *
     * @return array
     */
    public function getRoles(): array
    {
        return $this->payload->account_data->roles ?? [];
    }

    /**
     * Get the clinics (branches) from the account data in the JWT payload.
     *
     * @return array
     */
    public function getClinics(): array
    {
        return $this->payload->account_data->branches ?? [];
    }

    /**
     * Get the organizations from the account data in the JWT payload.
     *
     * @return array
     */
    public function getOrganizations(): array
    {
        return $this->payload->account_data->organizations ?? [];
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $roleCode The code of the role to check (e.g., 'ADM').
     * @return bool
     */
    public function hasRole(string $roleCode): bool
    {
        foreach ($this->getRoles() as $role) {
            if ($role->code === $roleCode) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user belongs to a specific branch (clinic).
     *
     * @param int $branchId The ID of the branch to check.
     * @return bool
     */
    public function belongsToBranch(int $branchId): bool
    {
        foreach ($this->getClinics() as $branch) {
            if ($branch->id == $branchId) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all clinic (branch) IDs associated with the user.
     *
     * @return array
     */
    public function getClinicIds(): array
    {
        $clinicIds = [];
        $clinics = $this->getClinics();

        foreach ($clinics as $clinic) {
            if (isset($clinic->id)) {
                $clinicIds[] = $clinic->id;
            }
        }

        return $clinicIds;
    }

    /**
     * Get all organization IDs associated with the user.
     *
     * @return array
     */
    public function getOrganizationIds(): array
    {
        $organizationIds = [];
        $organizations = $this->getOrganizations();

        foreach ($organizations as $organization) {
            if (isset($organization->id)) {
                $organizationIds[] = $organization->id;
            }
        }

        return $organizationIds;
    }

    /**
     * Get the name of the password field.
     * Not used for JWT authentication.
     *
     * @return string|null
     */
    public function getAuthPasswordName()
    {
        return null;
    }
}
