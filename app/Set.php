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
        return $this->hasOne(Language::class, 'id', 'languages1_id');
    }

    public function language2()
    {
        return $this->hasOne(Language::class, 'id', 'languages2_id');
    }
}
