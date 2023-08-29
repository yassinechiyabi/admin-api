<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\facture;

class factureController extends Controller
{
    public function getAllFacture(Request $request){
        $facture=facture::all()->values();
        return response()->json($facture);
    }
    
}
