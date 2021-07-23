<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonViTinhBigModel extends Model
{
    protected $table = 'dvt_big';
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    public $timestamps = false;
}
