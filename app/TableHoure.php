<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableHoure extends Model
{
    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'table_houres';

    protected $fillable = ['discipline_id', 'group_id', 'teacher_id', 'otherhour_id', 'hour'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function discipline()
    {
        return $this->belongsTo('App\Discipline');
    }

    public function category()
    {
        return $this->belongsTo('App\CategoryHours', 'otherhour_id');
    }

}
