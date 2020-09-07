<?php

namespace WPEloquent\Traits;

trait HasRoles
{
    /**
     * Check if the User has a specified role.
     *
     * @param string $role
     * @return boolean
     */
    public function hasRole(string $role = ''): bool
    {
        return in_array($role, $this->roles);
    }

    /**
     * Get the User roles.
     *
     * @return array
     */
    public function getRolesAttribute(): array
    {
        return array_keys($this->getMeta('wp_capabilities'));
    }

    /**
     * Check if the User is an admin.
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('administrator');
    }

    /**
     * Check if the User is an editor.
     *
     * @return boolean
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    /**
     * Check if the User is an author.
     *
     * @return boolean
     */
    public function isAuthor(): bool
    {
        return $this->hasRole('author');
    }

    /**
     * Check if the User is a contributor.
     *
     * @return boolean
     */
    public function isContributor(): bool
    {
        return $this->hasRole('contributor');
    }

    /**
     * Check if the User is a subscriber.
     *
     * @return boolean
     */
    public function isSubscriber(): bool
    {
        return $this->hasRole('subscriber');
    }
}
