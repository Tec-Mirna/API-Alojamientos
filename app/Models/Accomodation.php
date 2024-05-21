<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    // desde el controlador solo pueda tocar estos atributos
    protected $fillable = [
        'name',
        'address',
        'capacity',
        'rooms',
        'image_url',
        'price',
        'description',
        'disabled',
    ];
}
