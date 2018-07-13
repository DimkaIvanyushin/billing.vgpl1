<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';


    public function houre()
    {
        return $this->hasMany('App\TableHoure','group_id');
    }

}
