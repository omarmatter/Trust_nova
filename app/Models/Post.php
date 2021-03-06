<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $casts = [
        'image' => 'json',
    ];
    protected $fillable=['title','content','user_id'];

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'tag_post'
        );
    }
}
