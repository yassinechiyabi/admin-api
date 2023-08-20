<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class liste_element_controller extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'id_entreprise' => 'required|numeric',
            'id_liste' => 'required|numeric',
        ]);

        $element=new liste_element();
        $element->id_entreprise=$validated['id_entreprise'];
        $elemennt->id_liste=$validated['id_liste'];
        if($element->save()){ return response("l'entreprise id".$validated['id_entreprise']. " insérer dans liste avec succes",200);}
        else{ return response("l'entreprise id".$validated['id_entreprise']." non insérer",401);}
    }
}
