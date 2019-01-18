<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;

    const DELETED_AT = 'deleted';

    public function set()
    {
        return $this->hasMany(Set::class);
    }
}
