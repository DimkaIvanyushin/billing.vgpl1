<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplineType extends Model
{
    /**
     * Получить дисциплины данного типа
     */
    public function disciplines()
    {
        return $this->hasMany('App\Discipline');
    }
}
