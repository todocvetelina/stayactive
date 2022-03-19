<?php

namespace App\Models;

use App\Models\Boilerplate\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
