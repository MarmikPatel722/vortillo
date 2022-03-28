<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    public $table = 'state';
    protected $primaryKey = 'id';

    public function country()
    {
        return $this->hasOne('App\Country', 'id' ,'country_id');
    }
}
