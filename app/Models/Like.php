<?php

namespace App\Models;

use App\Models\Like as ModelsLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'blog_id',
        
    ];
    public function user()
    {
    	return $this->belongsTo(User::class,'id','user_id');
    }
    public function blog()
    {
    	return $this->belongsTo(Blog::class,'id','blog_id');
    }
}
