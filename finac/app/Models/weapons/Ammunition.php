<?php

namespace App\Models\weapons;

use App\Models\armory\Armory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ammunition extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'type',
        'caliber',
        'quantity_in_stock',
    ];

    public function armory()
    {
        return $this->belongsTo(Armory::class, 'armory_id');
    }

}
