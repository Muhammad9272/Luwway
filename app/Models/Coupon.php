<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'price', 'times','apply_to','apply_val','multi_check','t_check', 'start_date','end_date'];
    public $timestamps = false;
}
