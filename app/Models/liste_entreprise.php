<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liste_entreprise extends Model
{
    use HasFactory;
    protected $table = 'liste_entreprise';

    public function entreprises()
    {
        return $this->hasManyThrough(entreprise::class, liste_element::class);
    }

    public function entreprise()
    {
        return $this->belongsToMany(entreprise::class,'liste_element','id_liste_entreprise','id_entreprise');
    }
}
