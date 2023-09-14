<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Livro extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'titulo',
        'descricao',
        'autor',
        'numero_de_paginas',
        'data_de_cadastro',
    ];

    protected $casts = [
        'created_at'  => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    // Define a função boot() para configurar o comportamento dos campos created_at e updated_at
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->updated_at = null;
        });
    }
}
