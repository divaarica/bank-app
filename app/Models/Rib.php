<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rib extends Model
{
    use HasFactory;

    protected $fillable = [
        'codeBanque',
        'codeGuichet',
        'cleRib',
        'iban',
        'bic',
        'id_compte',
    ];

}
