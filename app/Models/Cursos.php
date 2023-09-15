<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'nivel',
        'capacidad',
    ];
}
