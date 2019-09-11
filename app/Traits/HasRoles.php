<?php
declare(strict_types=1);

namespace App\Traits;

trait HasRoles
{
    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')
            ->where(function ($query) {
                $query->whereNull('expires_at');
                $query->orWhere('expires_at', '>', now());
            })
            ->withTimestamps();
    }

    /**
     * Determine whether a user has a certain role.
     *
     * @param  string|array  $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return $this->roles->pluck('name')->intersect($role)->isNotEmpty();
        }

        return $this->roles->contains('name', $role);
    }
}
