<?php

namespace App\Http\Controllers;

use App\Models\Usagers;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class UsagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usagers = Usagers::latest()->get();
foreach($usagers as $u){
    $u->age = Carbon::parse($u->dob)->diff(\Carbon\Carbon::now())->format('%y ans');
    $u->quartier = DB::table('quartiers')->where('id', '=', $u->quartier)->first()->nom;
}

        return view('usagers.usagers', compact("usagers"));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["ages"] =DB::table('ages')->get();
        $data["categories_sociopro"] =DB::table('categories_sociopro')->get();
  
        $data["quartiers"] =DB::table('quartiers')->get();

        return view("usagers.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $usager = new Usagers();
        $usager->nom = $request->nom;
        $usager->nom_naissance = $request->nom_naissance;
        $usager->prenom = $request->prenom;
        $usager->adresse = $request->adresse;
        $usager->cp = $request->cp;
        $usager->ville = $request->ville;
        $usager->tel = $request->tel;
        $usager->email = $request->email;
        $usager->num_secu = $request->num_secu;
        $usager->num_alloc = $request->num_alloc;
        $usager->categorie_sociopro = $request->categorie_sociopro;
        $usager->autre = $request->autre;
        $usager->dob = $request->dob;
        $usager->genre = $request->genre;
        $usager->quartier = $request->quartier;
        $usager->save();
        return redirect()->route('usagers.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usagers  $usagers
     * @return \Illuminate\Http\Response
     */
    public function show(Usagers $usagers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usagers  $usagers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Usagers $usagers)
    {
       
        $id = $request->usager;
        $a = \App\Models\Usagers::where('id', $id)->first();
        $data['usagers'] = $a;
        return view("usagers.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usagers  $usagers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $usager)
    {
       
       
       
        $id = $request->usager;

     
        $usager = \App\Models\Usagers::where('id', $id)->first();
        
        $usager->nom = $request->nom;
        $usager->nom_naissance = $request->nom_naissance;
        $usager->prenom = $request->prenom;
        $usager->adresse = $request->adresse;
        $usager->cp = $request->cp;
        $usager->ville = $request->ville;
        $usager->tel = $request->tel;
        $usager->email = $request->email;
        $usager->num_secu = $request->num_secu;
        $usager->num_alloc = $request->num_alloc;
        $usager->categorie_sociopro = $request->categorie_sociopro;
        $usager->autre = $request->autre;
        $usager->save();
        return redirect()->route('usagers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usagers  $usagers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usagers $usager)
    {
        

       
        // On les informations du $post de la table "posts"
        $usager->delete();
    
        return redirect()->route('usagers.index');



    }
}
