<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
    protected $fillable =[
        "user_name",
        "email",
        "profile_pic",
        "full_name",
        "bio",
    ];
}
