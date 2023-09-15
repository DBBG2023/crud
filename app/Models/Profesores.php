<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    use HasFactory;
    protected $table = 'profesores';

    protected $fillable = [
        'nombre',
        'edad',
        'materia',
        'años_experiencia',
    ];
}
