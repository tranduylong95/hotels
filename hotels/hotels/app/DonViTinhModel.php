<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonViTinhModel extends Model
{
    protected $table = 'dvt';
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
}
