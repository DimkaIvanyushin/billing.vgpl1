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

    /**
     * Получить тпи данной дисциплиныы
     */
    public function discipline_type()
    {
        return $this->belongsTo('App\DisciplineType','disciplinetype_id');
    }
}
