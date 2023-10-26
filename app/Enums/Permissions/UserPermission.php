<?php

namespace App\Enums\Permissions;

enum UserPermission
{
    case VIEW_SELF_USER;
    case VIEW_ANY_USER;
    case CREATE_USER;
    case UPDATE_SELF_USER;
    case UPDATE_ANY_USER;
    case DELETE_SELF_USER;
    case DELETE_ANY_USER;
}
