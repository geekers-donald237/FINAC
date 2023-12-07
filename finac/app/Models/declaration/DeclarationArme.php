<?php

namespace App\Models\declaration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclarationArme extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'date',
        'circonstance',
        'numero_serie',
        'marque',
        'photo',
    ];
}
