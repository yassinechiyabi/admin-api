<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\type_entreprise;

class typeEntrepriseController extends Controller
{
    public function getAllTypes(){
        return response()->json(type_entreprise::all());
    }
}
