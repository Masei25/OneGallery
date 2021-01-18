<?php

namespace App\Models;

use Cube\Http\Model;

class UsersModel extends Model
{
    protected static $schema = 'users';

    protected static $fields = array(
        'id',
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'access_type',
        'created_at',
        'updated_at'
    );

    const ACCESS_TYPE_ADMIN = 0;
    const ACCESS_TYPE_USER = 0;
}