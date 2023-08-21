<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZamowieniaPotrawy extends Model
{
    use HasFactory;

    protected $table = 'zamowienia_potrawy';


    protected $fillable = [
        'zamowienie_id',
        'potrawa_id',

    ];

    public function potrawy(){
        return $this->belongsTo(Potrawa::class,'potrawa_id');
   }
}
