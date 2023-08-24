<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    protected $table = 'bar_zamowienia';


    protected $fillable = [
        'id_zamowienia',
    ];

    public function zamowienia()
    {
        return $this->belongsToMany(Zamowienia::class, 'bar_zamowienia', 'id', 'id_zamowienia');
    }
    public function potrawy(){

        return $this->belongsToMany(Potrawa::class,'zamowienia_potrawy','zamowienie_id','potrawa_id');
   }

}
