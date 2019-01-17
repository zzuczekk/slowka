<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function set()
    {
        return $this->hasMany(Set::class);
    }
}
