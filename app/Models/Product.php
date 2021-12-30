<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'category_id',
        'price',
       
    ];
    protected $hidden=[
        'created_at',
        'updated_at',
    ];

        public function getImageAttribute($value)
    {
        return $value ? asset('storage/image'.'/'.$value) : NULL;
    }
    public function getcategory()
    {
    	return $this->hasOne(Productcategory::class,'id','category_id');
    }
    
  
}
