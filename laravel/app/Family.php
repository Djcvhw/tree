<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table="family"; //нзвание таблицы в базе
    protected $fillable=['name'];

}
