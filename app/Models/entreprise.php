<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entreprise extends Model
{
    use HasFactory;
    protected $table = 'entreprise';


    public function listes()
    {
        return $this->belongsToMany(liste_entreprise::class,'liste_element', 'id_entreprise', 'id_liste_entreprise');
    }
    
}
