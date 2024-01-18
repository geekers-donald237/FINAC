<?php

namespace App\Models\weapons;

use App\Models\armory\Armory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeaponType extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['id' , 'type', 'quantity', 'description','armory_id'];

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public function weapons()
    {
        return $this->hasMany(Weapon::class, 'weapon_type_id');
    }

    public function armory() {
        return $this->belongsTo(Armory::class, 'armory_id');
    }

}
