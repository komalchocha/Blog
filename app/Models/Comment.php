<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'user_id',
        'blog_id',
        'parent_id',
         
     ];
     protected $hidden = [
        'created_at',
        'updated_at',
    ];
     public function user()
     {
         return $this->hasOne(User::class,'id','user_id');
     }
     public function blog()
     {
         return $this->belongsTo(Blog::class,'id','blog_id');
     }
     public function replies()
     {
         return $this->hasMany(Comment::class, 'parent_id');
     }
     public function getBlogname()
     {
         return $this->hasOne(Blog::class,'id','blog_id');
     }
     public function getuser()
     {
         return $this->hasOne(User::class,'id','user_id');
     }
     
}
