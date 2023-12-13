<?php

namespace App\Models\declaration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'surname',
        'dateNaissance',
        'lieuNaissance',
        'photoRecto',
        'photoVerso',
        'date',
        'adresse',
        'description',
    ];
}
