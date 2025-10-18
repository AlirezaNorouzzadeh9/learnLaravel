<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInfo extends Model
{
   use HasFactory;
   
   protected $fillable = [
    'user_id',
    'age',
    'whatapp'
   ];
   
   public function user()
   {
    return $this->belongsTo(User::class);
   }
}
