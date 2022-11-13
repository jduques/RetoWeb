<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = "pacientes";
    protected $fillable = ['nombre', 'nfecha', 'sexo', 'estatura', 'peso'];
    protected $casts = [
        'nfecha' => 'datetime:d/m/Y',
    ];

}
