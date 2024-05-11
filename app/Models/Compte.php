<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_type',
        'id_pack',
        'id_client',
        'numero',
        'balance',
        'state',
    ];

    public function type()
    {
        return $this->belongsTo(TypeCompte::class, 'id_type');
    }

    public function pack()
    {
        return $this->belongsTo(Packs::class, 'id_pack');
    }

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'id_client');
    }

    public function rib()
    {
        return $this->hasOne(Rib::class, 'id_compte');
    }
}
