<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;


    protected $table = 'status_zamowienia';


    protected $fillable = [
        'status'
    ];

    public function zamowienia()
    {
        return $this->hasMany(Zamowienia::class, 'id_statusu_kuchnia');
    }
}
