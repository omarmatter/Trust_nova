<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class product extends Model
{
    use HasFactory , HasTranslations;
    protected  $guarded=[];
    public $translatable = ['name' ,'desc'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productDetailse()
    {
        return $this->hasMany(product_detailse::class );
    }
    // constants
    public static function productStatuses() {
        return [
            '0' =>'in stock' ,
            '1' => 'out of stock'
        ];
    }
}
