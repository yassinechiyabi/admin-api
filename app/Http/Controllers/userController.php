<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\user;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{


    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'prenom' => 'required|max:255',
            'password' => 'required',
            'email'=> 'required|email',
            'adresse'=> 'required|max:300',
            'city'=> 'required|max:255',
            'country'=> 'required|max:255',
            'zip'=> 'required|max:255',
            'entreprise'=> 'required|max:255',
            'type_entreprise'=> 'required|numeric',
            'siren' => 'required|max:255',
            'phone' => 'sometimes|max:255'
            

        ]);

        $user = new user();
        $user->name=$validated['name'];
        $user->prenom=$validated['prenom'];
        $user->adresse=$validated['adresse'];
        $user->email=$validated['email'];
        $user->city=$validated['city'];
        $user->country=$validated['country'];
        $user->zip=$validated['zip'];
        $user->entreprise=$validated['entreprise'];
        $user->type_entreprise=$validated['type_entreprise'];
        $user->siren=$validated['siren'];
        $user->phone=$validated['phone'];
        $user->password=Hash::make($validated['password']);
        if($user->save()){ return response("User registred successfully",200);}
        else{return response("User register error",401);}

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response("Authentification Réussie",200);
        }
 
        
    }

    public function isAuthenticated(Request $request){
        if (Auth::check()) {
            $request->session()->regenerate();
            return response("L'utilisateur est connecté".Auth::id(),200);
        }
        else{
            return response("Utilisateur non authentifier",401);
        }
    }

    public function logout(Request $request)
    {

        
        Auth::logout();
        $request->session()->regenerateToken(); 
        $request->session()->invalidate(); 
        return response("Utilisateur deconnecté",200);
        
        
    }





    public function getCurrentUser(){

        return response(Auth::user());
    }
    public function getCurrentUserRole(){
        
        return response(user::where('id',Auth::id())->get('role_user'));
    }

    public function updateUser(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email'=> 'required|email',
            'adresse'=> 'required|max:300',
            'city'=> 'required|max:255',
            'country'=> 'required|max:255',
            'zip'=> 'required|max:255',
            'entreprise'=> 'required|max:255',
            'type_entreprise'=> 'required|numeric',
            'id'=> 'required|numeric',
            'siren' => 'required|max:255',
            

        ]);

        $user = User::find($validated['id']);
        $user->name=$validated['name'];
        $user->prenom=$validated['prenom'];
        $user->adresse=$validated['adresse'];
        $user->email=$validated['email'];
        $user->city=$validated['city'];
        $user->country=$validated['country'];
        $user->zip=$validated['zip'];
        $user->entreprise=$validated['entreprise'];
        $user->type_entreprise=$validated['type_entreprise'];
        $user->siren=$validated['siren'];
        
        if($user->save()){ return response("User updated successfully",200);}
        else{return response("User updated error",401);}

    }
}
