<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name'];

    /**
     * Получить часы
     */
    public function hours()
    {
        return $this->hasMany('App\TableHoure');
    }

    /**
     * Получить прочие часы
     */
    public function other_hour()
    {
        return $this->hasMany('App\OtherHoure')->select(array('elective_hour', 'DK_hour', 'room_hour', 'examinations_hour'));
    }

}
