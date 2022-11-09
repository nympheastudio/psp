<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


use Carbon\Carbon;
use DB;
use Input;
//use File;
use ZipArchive;
use App\Models\Interventions;
use App\Models\Usagers;
//
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Exception;

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
        
        
        //add column
        // genre, âge, catégorie socio-pro, quartier, type d’intervention, thématique et sous thématique
        
        
        foreach($interventions as $i){
            
            $i->categorie = DB::table('interventions_categorie')->find($i->id_interventions_categorie)->nom;
            $prenom = DB::table('usagers')->find($i->usager_id)->prenom;
            $i->nom_beneficiaire = DB::table('usagers')->where('id', '=', $i->usager_id)->first()->nom . ' ' . $prenom;
            $i->genre = DB::table('usagers')->where('id', '=', $i->usager_id)->first()->genre;
            $dob= DB::table('usagers')->where('id', '=', $i->usager_id)->first()->dob;
            
            $i->age = Carbon::parse($dob)->diff(\Carbon\Carbon::now())->format('%y ans');
            
            $quartier = DB::table('usagers')->where('id', '=', $i->usager_id)->first()->quartier;
            if($quartier)  $i->quartier = DB::table('quartiers')->where('id', '=', $quartier)->first()->nom;
            $categorie_sociopro = DB::table('usagers')->where('id', '=', $i->usager_id)->first()->categorie_sociopro;
            if($categorie_sociopro)  $i->categorie_sociopro = DB::table('categories_sociopro')->where('id', '=', $categorie_sociopro)->first()->nom;
            
            
            //  
            if($i->id_thematique) $i->thematique = DB::table('thematiques')->where('id', '=', $i->id_thematique)->first()->nom;
            if($i->id_sous_thematique) $i->sous_thematique = DB::table('sous_thematiques')->where('id', '=', $i->id_sous_thematique)->first()->nom;
        }
        
        
        
        
        return view('interventions.interventions', compact("interventions"));
        
    }
    
    
    public function reportingsExport(Request $request)
    {
        
        $defaultStyle = (new StyleBuilder())
        ->setFontName('Arial')
        ->setFontSize(11)
        ->build();
        
        
        $header_style = (new StyleBuilder())
        ->setFontBold()
        ->setFontSize(12)
        ->setFontColor('ffffff')
        ->setBackgroundColor('000000')
        ->build();
        
        $id_user = $request->users;
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        /*
        if($id_user != '' && $date_start == '' && $date_end == ''){
            
            $interventions = Interventions::where('id_user', '=', $id_user)->get();
        }
        
        if($id_user != '' && $date_start != '' && $date_end != ''){
            $interventions = Interventions::where('id_user', '=', $id_user)->whereBetween('date_intervention', [$date_start, $date_end])->get();
            
            
            
            
            
            
        }
        
        if($id_user == '' && $date_start != '' && $date_end != ''){
            $interventions = Interventions::whereBetween('date_intervention', [$date_start, $date_end])->get();
        }
        
        if($id_user == '' && $date_start == '' && $date_end == ''){
            $interventions = Interventions::all();
        }
        
        if($id_user == '' && $date_start != '' && $date_end == ''){
            $interventions = Interventions::where('date_intervention', '=', $date_start)->get();
        }
        
        if($id_user == '' && $date_start == '' && $date_end != ''){
            $interventions = Interventions::where('date_intervention', '=', $date_end)->get();
        }
        */
        if($id_user != '' ){
            
            $interventions = Interventions::where('id_user', '=', $id_user)->get();
        }else{
            $interventions = Interventions::all();
        }
        $events = DB::table('crud_events')->get();
        
        foreach($interventions as $i){
            
            foreach($events as $e){
                if($e->intervention_id == $i->id){
                    $i->date_intervention = $e->event_start.'--';
                }
            }
            
        }

        if($date_start != '' && $date_end != ''){
            $interventions = $interventions->whereBetween('date_intervention', [$date_start, $date_end]);
        }
        
        //   $interventions = Interventions::get();
        
        $export_data = (
            new FastExcel($interventions))
            ->headerStyle($header_style)
            ->rowsStyle($defaultStyle)
            
            ->download('export_interventions.xlsx', function ($interventions){
                
                if($interventions->type_intervention != ''){
                    $type_intervention =     DB::table('interventions_categorie')->find($interventions->id_interventions_categorie)->nom;
                }else{
                    $type_intervention = '';
                }
                
                if($interventions->id_thematique != ''){
                    $thematique = DB::table('thematiques')->where('id', '=', $interventions->id_thematique)->first()->nom;
                }else{
                    $thematique = '';
                }
                
                if($interventions->id_sous_thematique!=''){
                    $sous_thematique = DB::table('sous_thematiques')->find($interventions->id_sous_thematique)->nom;
                }else{
                    $sous_thematique = '';
                }
                
                $date_interventions = $interventions->date_intervention;//data ecrasé si un rdv est planifié
                
                $events = DB::table('crud_events')->where('intervention_id', '=', $interventions->id)->get();
                
                foreach( $events as $event){
                    $date_interventions = $event->event_start . ' - ' . $event->event_end . ' ';
                }
                
                
                if($interventions->id_user != ''){
                    $user = DB::table('users')->find($interventions->id_user)->name;
                }else{
                    $user = '';
                }
                
                if($interventions->usager_id != ''){
                    $nom_beneficiaire = DB::table('usagers')->where('id', '=', $interventions->usager_id)->first()->nom . ' ' . DB::table('usagers')->where('id', '=', $interventions->usager_id)->first()->prenom;
                    $genre = DB::table('usagers')->where('id', '=', $interventions->usager_id)->first()->genre;
                    $age = Carbon::parse(DB::table('usagers')->where('id', '=', $interventions->usager_id)->first()->dob)->diff(\Carbon\Carbon::now())->format('%y ans');
                    $quartier = DB::table('quartiers')->where('id', '=', DB::table('usagers')->where('id', '=', $interventions->usager_id)->first()->quartier)->first()->nom;
                    $categorie_sociopro = DB::table('categories_sociopro')->where('id', '=', DB::table('usagers')->where('id', '=', $interventions->usager_id)->first()->categorie_sociopro)->first()->nom;
                }else{
                    $nom_beneficiaire = '';
                    $genre = '';
                    $age= '';
                    $quartier ='';
                    $categorie_sociopro = '';
                }
                
                
                return [
                    'Numéro intervention'=> $interventions->id,
                    'Date intervention'=> $date_interventions,
                    'utilisateur'=> $user,
                    'Type intervention'=> $type_intervention,
                    'Résultat'=> $interventions->resultat,
                    'Thématique'=> $thematique,
                    'Sous thématique'=>  $sous_thematique,
                    'Nom bénéficiaire'=> $nom_beneficiaire,
                    'Genre'=> $genre,
                    'Age'=> $age,
                    'Quartier'=> $quartier,
                    'Catégorie socio-professionnelle'=> $categorie_sociopro,
                    
                    
                    
                    
                    
                    
                    
                ];
                
            });
            
            return $export_data;
        }
        public function reportings()
        {
            
            $data["users"] = DB::table('users')->get();
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
                $data["users"] = DB::table('users')->orderBy('name', 'asc')->get();
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
            $data["users"] = DB::table('users')->orderBy('name', 'asc')->get();
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
