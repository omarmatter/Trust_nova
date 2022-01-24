<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $casts = [
        'documents' => 'json',
    ];
    protected $fillable = ['id', 'user_id' , 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function files()
    {
        return $this->hasMany(File::class );
    }
    public function replies()
    {
        return $this->morphMany(reply::class,'replyable');
    }

}
