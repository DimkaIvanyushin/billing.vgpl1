<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{

    protected $fillable = ['name'];

    public function hours()
    {
        return $this->hasMany('App\TableHoure');
    }

}
