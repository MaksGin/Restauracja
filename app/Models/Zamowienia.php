<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zamowienia extends Model
{
    use HasFactory;

    protected $table = 'zamowienia';


    protected $fillable = [
        'id_kelnera',
        'id_stoliku',
        'cena',
    ];

    public function potrawy(){
        return $this->belongsToMany(Potrawa::class,'zamowienia_potrawy','zamowienie_id','potrawa_id');
   }

}
