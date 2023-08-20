<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\formulaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class formulaireController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'nom_formulaire' => 'required|max:255',
            'date_formulaire' => 'required|max:255',
            'liste_formulaire'=> 'required|numeric',
            'contenu_formulaire' => 'max:3000',
            'dcformulaire' => 'sometimes|mimes:pdf',
            'type_save'=> 'numeric'
        ]);
        if($validated['type_save']==1){ 
        $path = Storage::putFile('public', $request->file('dcformulaire'));
        $path=substr($path, 7);
        }
        else{$path="";}

        $frm=new formulaire();
        $frm->nom_formulaire=$validated['nom_formulaire'];
        $frm->created_at=$validated['date_formulaire'];
        $frm->updated_at=$validated['date_formulaire'];
        $frm->contenu_formulaire=$validated['contenu_formulaire'];
        $frm->id_liste_entreprise=$validated['liste_formulaire'];
        $frm->dc_path=$path;
        $frm->type_save=$validated['type_save'];
        $frm->id_user=Auth::id();


        if($frm->save()){return response('Formulaire enregistré avec succes',200);}
        else{return response('Formulaire erroné',401);}

    }

    public function showAll(){
        return response()->json(formulaire::all()->where('id_user',Auth::id())->values());
    }
    public function getCountInitValueByMonth(Request $request):Array{
        for ($i = 1; $i <13; $i++) {
            $month['data'.$i]=formulaire::whereMonth('created_at','=',$i)->where("id_user",Auth::id())->sum('valeur_initial');
        }
        return $month;
    }
}
