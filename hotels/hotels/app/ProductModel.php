<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    public $timestamps = false;
}
