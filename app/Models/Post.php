<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Postはデフォルトではpostsテーブルに紐づいている。
class Post extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'body',
    ];

    public function Comments(){

        return $this->hasMany(Comment::class);

    }
}
