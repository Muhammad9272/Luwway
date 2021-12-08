<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorSchedule extends Model
{
	protected $fillable = ['opening1','closing1','closed1',
	                       'opening2','closing2','closed2',
	                       'opening3','closing3','closed3',
	                       'opening4','closing4','closed4',
	                       'opening5','closing5','closed5',
	                       'opening6','closing6','closed6',
	                       'opening7','closing7','closed7',
                          ];
    public function IsSchedule($id)
    {
       return VendorSchedule::where('vendor_id','=',$id)->get()->count();
    }
}
