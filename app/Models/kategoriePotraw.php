<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriePotraw extends Model
{
    use HasFactory;

    protected $table = 'kategorie_potraw';

    public function potrawy(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Potrawa::class,'id_kategorii','id');
    }
}
