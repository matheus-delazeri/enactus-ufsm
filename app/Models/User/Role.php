<?php

namespace App\Models\User;
class Role extends \Spatie\Permission\Models\Role
{
    /**
     * User's with this role have all permissions granted as default
     * @see \App\Providers\AuthServiceProvider;
     */
    public const SUPER_ADMIN = "SUPER_ADMIN";

    /**
     * User's with this role will have all permissions related to post's
     * management
     *
     * @see
     */
    public const EDITOR = "EDITOR";

}
