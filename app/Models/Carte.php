<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'id_client',
        'type',
        'montant',
        'cvv',
        'date_expiration',
    ];


    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'id_client');
    }
}
