<?php

namespace App\Models\weapons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ammunition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'caliber',
        'quantity_in_stock',
    ];


}
