<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiejsceRealizacji extends Model
{
    use HasFactory;

    protected $table = 'miejsce_realizacji';

    public function kategorie(){

        //moze miec wiele kategorii potraw
        return $this->hasMany(kategoriePotraw::class,'miejsce_realizacji','id');
    }
}
