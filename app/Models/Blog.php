<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Blog extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'user_id',
        'categorie_id',
    ];
    public function Likes()
    {
    	return $this->hasMany(Blog::class,'blog_id','id')->count();
    }
      public function getImageAttribute($value)
    {
        return $value ? asset('storage/image'.'/'.$value) : NULL;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    public function like()
    {
    	return $this->hasMany(Like::class,'blog_id','id');
    }
    public function comment()
    {
    	return $this->hasMany(Comment::class,'blog_id','id');
    }
    public function getcategory()
    {
    	return $this->hasOne(Blogcategory::class,'id','categorie_id');
    }
  
    public function getuser()
    {
    	return $this->hasOne(User::class,'id','user_id');
    }
    public function getlike()
    {
    	return $this->hasMany(Like::class,'blog_id','id')->count();
    }
    public function getcomment()
    {
    	return $this->hasMany(Comment::class,'blog_id','id')->count();
    }
}
