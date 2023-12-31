<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'lista';

    protected $fillable = [
        'titulo',
        'descricao',
        'inicio',
        'fim',
    ];
}
