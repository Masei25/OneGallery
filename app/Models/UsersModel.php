<?php

namespace App\Models;

use Cube\Http\Model;

class UsersModel extends Model
{
    protected static $schema = 'users';

    const ACCESS_TYPE_ADMIN = 1;
    const ACCESS_TYPE_USER = 0;

    protected static $fields = array(
        'id',
        'username',
        'email',
        'password',
        'access_type',
        'created_at',
        'updated_at'
    );
}