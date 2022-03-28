<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{

    public $table = 'person_address';
    protected $primaryKey = 'person_id';

    public function address()
    {
        return $this->hasOne('App\Address', 'id' ,'address_id')->with('state');
    }
}
