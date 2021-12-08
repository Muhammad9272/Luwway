<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialsetting extends Model
{
    protected $fillable = ['facebook', 'twitter', 'gplus', 'linkedin', 'dribble','youtube','pinterest','instagram', 'f_status', 't_status', 'g_status', 'l_status', 'd_status','f_status','g_status','y_status','p_status','i_status','fclient_id','fclient_secret','fredirect','gclient_id','gclient_secret','gredirect'];
    public $timestamps = false;
}
