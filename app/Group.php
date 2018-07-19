<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    public function hours()
    {
        return $this->hasMany('App\TableHoure');
    }

}
