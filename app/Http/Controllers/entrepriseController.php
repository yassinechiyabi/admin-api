<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\entreprise;
use App\Models\liste_entreprise;
use Illuminate\Support\Facades\Auth;

class entrepriseController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'nom_entreprise' => 'required|max:255',
            'ville_entreprise' => 'required|max:255',
            'capital_entreprise'=> 'required|numeric'
        ]);

    

    $entreprise=new entreprise();
    $entreprise->nom_entreprise=$validated['nom_entreprise'];
    $entreprise->ville_entreprise=$validated['ville_entreprise'];
    $entreprise->capital_entreprise=$validated['capital_entreprise'];

    if($entreprise->save()){return response('Entreprise insérer avec succes')->header('Content-type','text/plain');}
    else{return response('Entreprise insertion erroner')->header('Content-type','text/plain');}
    }

    public function showAll(){
        $entreprises=entreprise::all();
        return response()->json($entreprises);
    }

    public function showByList(Request $request){
        $validated = $request->validate([
            'id_liste' => 'numeric',
        ]);

        $liste=liste_entreprise::with('entreprise')->where('id',$validated['id_liste'])->get();
        return response()->json($liste);

    }

    public function filter(Request $request){
        $validated = $request->validate([
            'critere_recherche' => 'max:255',
            'valeur_recherche' => 'max:255',
            'valeur_capital_superieure' => 'max:255',
            'valeur_capital_inferieure' => 'max:255',
            
        ]);
        if($validated['valeur_recherche']==""){
            $entreprises=entreprise::all();
        return response()->json($entreprises);
        }
        elseif($validated['critere_recherche']=="capital_entreprise"){

            if($validated['valeur_capital_inferieure']==""){ $entreprises=entreprise::where($validated['critere_recherche'],'>=', $validated['valeur_capital_superieure'])->get();}
            elseif($validated['valeur_capital_superieure']==""){ $entreprises=entreprise::where($validated['critere_recherche'],'<=', $validated['valeur_capital_inferieure'])->get();}
            elseif($validated['valeur_capital_superieure']=="" && $validated['valeur_capital_inferieure']==""){$entreprises=entreprise::all();
                return response()->json($entreprises);}
            else{$entreprises=entreprise::whereBetween($validated['critere_recherche'],[$validated['valeur_capital_superieure'],$validated['valeur_capital_inferieure']])->get();}
            return response()->json($entreprises);
        }
        else{
        $entreprises=entreprise::where($validated['critere_recherche'],'LIKE', $validated['valeur_recherche']."%")->get();
        return response()->json($entreprises);
        }
    }
}
