<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    use HasFactory;
    protected $guarded=[];
    public  function  replyeable(){

        return $this->morphTo('replyable');
    }
}
