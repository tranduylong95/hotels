<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
}
