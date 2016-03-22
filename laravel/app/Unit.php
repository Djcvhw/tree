<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table="unit"; //нзвание таблицы в базе
    protected $fillable=['name', 'parent_1', 'parent_2', 'family_id'];
}
