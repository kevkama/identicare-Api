<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
    use HasFactory;
    protected $fillable =[
        "community_name",
        "description",
        "profile_id",
    ];
}
