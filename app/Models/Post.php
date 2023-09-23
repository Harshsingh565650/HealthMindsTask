<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
     
    protected $guarded = [];
     /*
        * to get the details from User Table using foreign
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function Username(){
        return $this->belongsTo(User::class,'user_id');
    }
}
