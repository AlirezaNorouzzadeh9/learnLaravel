<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];
    
    public function user()
    {
        return $this->beLongsTo(User::class, 'post');
    }
}
