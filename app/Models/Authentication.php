<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens; // generación de tokens

class Authentication extends Model
{
    use HasFactory, Authenticatable, HasApiTokens;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'role'
    ];
}
