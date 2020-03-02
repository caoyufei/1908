<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Username extends Model
{
    protected $table='username';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];
}
