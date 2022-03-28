<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    public $table = 'address';
    protected $primaryKey = 'id';

    
    public function state()
    {
        return $this->hasOne('App\State', 'id' ,'state_id')->with('country');
    }
}
