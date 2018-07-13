<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    /**
     * Массово присваиваемые атрибуты.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Получить преподавателя - владельца данной записи
     */
    public function teacer()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Получить дисциплину данной записи
     */
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    /**
     * Получить группу данной записи записи
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
