<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'id_compte_emetteur',
        'id_compte_destinataire',
        'id_emetteur',
        'id_destinataire',
        'montant',
        'id_type',
    ];


    public function emetteur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_emetteur');
    }

    public function recepteur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_destinataire');
    }

    public function compte_emetteur()
    {
        return $this->belongsTo(Compte::class, 'id_compte_emetteur');
    }

    public function compte_recepteur()
    {
        return $this->belongsTo(Compte::class, 'id_compte_destinataire');
    }

    public function type_transaction()
    {
        return $this->belongsTo(TypeTransaction::class, 'id_type');
    }
}
