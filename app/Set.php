<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Set extends Model
{
    use SoftDeletes;

    const DELETED_AT = 'deleted';

    public function language1()
    {
        return $this->hasMany(Language::class);
    }

    public function language2()
    {
        return $this->hasMany(Language::class);
    }
}
