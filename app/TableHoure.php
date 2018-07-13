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

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
