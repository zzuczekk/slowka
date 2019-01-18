<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLES = [
        'EDITOR' => 'redaktor',
        'SUPER_EDITOR' => 'Super Redaktor',
        'ADMIN' => 'Administrator'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_role', 'roles_id', 'users_id');
    }
}
