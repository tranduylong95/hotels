<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceAfterModel extends Model
{
    protected $table = 'price_after';
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    public $timestamps = false;
}
