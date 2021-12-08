<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorOrder extends Model
{
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
