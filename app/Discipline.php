<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{

    protected $fillable = ['name'];

    /**
     * Получить все задачи дисциплины
     */
    public function get_entryes()
    {
        return $this->hasMany(Entry::class);
    }

}
