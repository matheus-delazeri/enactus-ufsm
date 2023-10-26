<?php

namespace App\Enums\Permissions;

enum PostPermission
{
    case VIEW_SELF_POST;
    case VIEW_ANY_POST;
    case CREATE_POST;
    case UPDATE_SELF_POST;
    case UPDATE_ANY_POST;
    case DELETE_SELF_POST;
    case DELETE_ANY_POST;
}
