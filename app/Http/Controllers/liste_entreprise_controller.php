<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\liste_entreprise;
use App\Models\liste_element;
use Illuminate\Support\Facades\Auth;

class liste_entreprise_controller extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'libelle_liste' => 'required|max:255',
            
        ]);
        $liste=new liste_entreprise();
        $liste->libelle_liste=$validated['libelle_liste'];
        $liste->id_user=Auth::id();
        if($liste->save()){ 
            echo "Liste créer - ";
            foreach($request['elements'] as $company){
                $element=new liste_element();
                $element->id_liste_entreprise=$liste->id;
                $element->id_entreprise=$company;
                if($element->save()){echo "Element ".$company ." créer - ";}
            }
        }
        
    }

    public function showAll(){
        return response()->json(liste_entreprise::all()->where('id_user',Auth::id())->values());
    }
}
