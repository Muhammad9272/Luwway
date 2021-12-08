<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = ['user_id', 'method', 'acc_email', 'iban', 'country', 'acc_name', 'address', 'swift', 'reference', 'amount', 'fee', 'created_at', 'updated_at', 'status','fname','mname','lname','phone_no','aaddress','country_id','state_id','city','aemail','zip_code'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
     public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }
 

    public function countryy()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    } 
}
