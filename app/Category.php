<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const DELETED_AT = 'deleted';

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'categories_id');
    }
}
