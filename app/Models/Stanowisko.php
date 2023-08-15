<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stanowisko extends Model
{
    use HasFactory;

    protected $table = 'lista_stanowisk';

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'id_stanowiska','id');
    }
}
