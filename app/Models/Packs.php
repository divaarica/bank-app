<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packs extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "libelle",
        "agios" ,
        "plafond",
    ];

    public function comptes()
    {
        return $this->hasMany(Compte::class, 'id_pack');
    }
}
