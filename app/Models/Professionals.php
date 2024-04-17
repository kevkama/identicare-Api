<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professionals extends Model
{
    use HasFactory;
    protected $fillable =[
        "name",
        "services_id",
        "profile_pic",
        "description",        
    ];
}