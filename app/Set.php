<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    public function language1()
    {
        return $this->hasMany(Language::class);
    }

    public function language2()
    {
        return $this->hasMany(Language::class);
    }
}
