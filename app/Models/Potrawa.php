<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potrawa extends Model
{
    use HasFactory;

    protected $table = 'lista_potraw';

    public function kategoria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(kategoriePotraw::class,'id_kategorii','id');
    }
}
