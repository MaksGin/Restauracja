<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuchnia extends Model
{
    use HasFactory;

    protected $table = 'kuchnia_zamowienia';

    protected $fillable = [
        'id_zamowienia',

    ];
    public function zamowienia()
    {
        return $this->belongsToMany(Zamowienia::class, 'kuchnia_zamowienia', 'id', 'id_zamowienia');
    }

}
