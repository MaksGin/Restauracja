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

   public function stolik(){
        return $this->belongsTo(Stolik::class, 'id_stoliku');
   }
   public function kuchnie()
    {
        return $this->belongsToMany(Kuchnia::class, 'kuchnia_zamowienia', 'id_zamowienia', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_statusu_kuchnia');
    }

    public function bar()
    {
        return $this->belongsToMany(Bar::class,'bar_zamowienia','id_zamowienia','id');

    }
    public function user(){
        return $this->belongsTo(User::class,'id_kelnera');
    }
}
