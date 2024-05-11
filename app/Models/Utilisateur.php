<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'numero',
        'nom',
        'prenom',
        'adresse',
        'tel',
        'numeroCI',
        'email',
        'password',
        'id_profil',
        'authentification',
        'state',
    ];

    // Relation pour récupérer les comptes associés à cet utilisateur
    public function comptes()
    {
        return $this->hasMany(Compte::class, 'id_client');
    }

    public function cartes()
    {
        return $this->hasMany(Compte::class, 'id_client');
    }
}
