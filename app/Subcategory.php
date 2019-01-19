<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;

    const DELETED_AT = 'deleted';

    public function sets()
    {
        return $this->hasMany(Set::class, 'subcategories_id');
    }
}
