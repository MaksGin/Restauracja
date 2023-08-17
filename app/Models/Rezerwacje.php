<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezerwacje extends Model
{
    use HasFactory;

    protected $table = 'rezerwacje';

    protected $fillable = [
        'id_stoly',
        'od',
        'do',
        'nazwisko',
    ];
}
