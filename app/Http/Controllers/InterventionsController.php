<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



use DB;
use Input;
//use File;
use ZipArchive;
use App\Models\Interventions;
use App\Models\Usagers;
//

class InterventionsController extends Controller
{
    
 /*
 id
 created_at
 updated_at

 usager_id
 date_intervention
 type_intervention

 oriente_par
 organismes_acte_1
 organismes_acte_2
 organismes_acte_3
 oriente_vers

 resultat
 observation

 id_user
 id_interventions_categorie
 id_thematique
 id_sous_thematique
*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $interventions = Interventions::latest()->get();
        return view('interventions.interventions', compact("interventions"));
       
    }

    public function reportings()
    {
        
        //$interventions = Interventions::latest()->get();
        $data["total_interventions"] = DB::table('interventions')->count();
        $data["total_usagers"] = DB::table('usagers')->count();
        $data["total_interventions_en_cours"] = DB::table('interventions')->where('resultat', 'En cours')->count();
        $data["total_interventions_cloturees"] = DB::table('interventions')->where('resultat', 'Réglé')->count();

        $data["total_interventions_2022"] = DB::table('interventions')->whereYear('date_intervention', '=', 2022)->count();
        $data["total_interventions_current"] = DB::table('interventions')->whereYear('date_intervention', '=', date('Y'))->count();

        return view('interventions.reportings', $data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(Auth::check()){
            
             /* $id = $request->usager;
        $a = \App\Models\Usagers::where('id', $id)->first();
*/
        $data["interventions_categorie"] = DB::table('interventions_categorie')->get();
        $data["usagers"] = DB::table('usagers')->get();
        $data["type_interventions"] = DB::table('types_intervention')->get();
        $data["thematiques"] =   DB::table('thematiques')->get();
        $data["sous_thematiques"] =  DB::table('sous_thematiques')->get();
        $data["users"] = DB::table('users')->get();
        $data["resultats"] =  DB::table('resultats')->get();

       
        return view("interventions.create", $data);
            
        }else{
            return redirect('login');
        }
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $intervention = new Interventions();
        $intervention->usager_id = $request->usager_id;
        $intervention->date_intervention = $request->date_intervention;
        $intervention->type_intervention = $request->type_intervention;
       // $intervention->oriente_par = $request->oriente_par;
       // $intervention->organismes_acte_1 = $request->organismes_acte_1;
       // $intervention->organismes_acte_2 = $request->organismes_acte_2;
       // $intervention->organismes_acte_3 = $request->organismes_acte_3;
       // $intervention->oriente_vers = $request->oriente_vers;
        $intervention->resultat = $request->resultat;
        $intervention->observation = $request->observation;
        $intervention->id_user = $request->user;
        $intervention->id_interventions_categorie = $request->interventions_categorie;
        $intervention->id_thematique = $request->thematique;
        $intervention->id_sous_thematique = $request->sous_thematique;


                //doc
                $id=$intervention->id;
                $file=$request->file('doc1');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc1_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc1 = $filename;
                }

                $file=$request->file('doc2');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc2_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc2 = $filename;
                }

                $file=$request->file('doc3');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc3_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc3 = $filename;
                }

                $file=$request->file('doc4');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc4_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc4 = $filename;
                }

                $file=$request->file('doc5');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc5_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc5 = $filename;
                }


        $intervention->save();

        
        return redirect()->route('interventions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function show(Interventions $interventions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Interventions $interventions) 
    {
        
        //get id intervention
        $id = $request->intervention;
        //echo $id.'--';
        $intervention = DB::table('interventions')->where('id', $id)->first();

       // var_dump($intervention);exit;
        $data["interventions_categorie"] = DB::table('interventions_categorie')->get();
        $data["usagers"] = DB::table('usagers')->get();
        $data["type_interventions"] = DB::table('types_intervention')->get();
        $data["thematiques"] =   DB::table('thematiques')->get();
        $data["sous_thematiques"] =  DB::table('sous_thematiques')->get();
        $data["users"] = DB::table('users')->get();
        $data["resultats"] =  DB::table('resultats')->get();
        $data["intervention"] = $intervention;

        $data["rdvs"] = DB::table('crud_events')->where('intervention_id','=',$id)->get();


        
        return view("interventions.edit", $data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interventions $interventions)
    {
        
        $id = $request->intervention;
        $intervention = Interventions::find($id);
        $intervention->usager_id = $request->usager_id;
        $intervention->date_intervention = $request->date_intervention;
        $intervention->type_intervention = $request->type_intervention;
       // $intervention->oriente_par = $request->oriente_par;
       // $intervention->organismes_acte_1 = $request->organismes_acte_1;
       // $intervention->organismes_acte_2 = $request->organismes_acte_2;
       // $intervention->organismes_acte_3 = $request->organismes_acte_3;
       // $intervention->oriente_vers = $request->oriente_vers;
        $intervention->resultat = $request->resultat;
        $intervention->observation = $request->observation;
        $intervention->id_user = $request->user;
        $intervention->id_interventions_categorie = $request->interventions_categorie;
        $intervention->id_thematique = $request->thematique;
        $intervention->id_sous_thematique = $request->sous_thematique;

      



         //doc
         $id= $intervention->id;
         $file=$request->file('doc1');
         if($file){
             $extension = $file->getClientOriginalExtension();
             $filename = 'doc1_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
             $file->move(public_path().'/files/interventions/', $filename);
             $intervention->doc1 = $filename;
         }
         $file=$request->file('doc2');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc2_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc2 = $filename;
                }

                $file=$request->file('doc3');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc3_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc3 = $filename;
                }

                $file=$request->file('doc4');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc4_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc4 = $filename;
                }

                $file=$request->file('doc5');
                if($file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc5_u' . Auth::id() . '_d'.$id.'.'.$extension; //$file->getClinetOriginalName();
                    $file->move(public_path().'/files/interventions/', $filename);
                    $intervention->doc5 = $filename;
                }
         $intervention->save();

        return redirect()->route('interventions.edit', $intervention->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interventions  $interventions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interventions $interventions)
    {
        //
    }
}
