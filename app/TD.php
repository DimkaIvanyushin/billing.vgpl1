<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TD extends Model
{
    protected $table = 't_ds';
    protected $fillable = ['teacher_id', 'discipline_id'];
}
