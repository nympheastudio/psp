<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CrudEvents;
use App\Models\Interventions;
use DB;



class CustomAuthController extends Controller
{
    public function index()
    {

        if(Auth::check()){
            return redirect("dashboard");
        }
  
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Vous êtes connecté');
        }
        
        return redirect("login")->withSuccess('Details de connexion non valides');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function edit(User $user)
    {
        
        return view('users.edit', compact('user'));
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function users()
    {
        $users = User::all();
        return view('users', compact("users"));
       
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
           // 'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        //echo $request->role.'qsdfghj';exit;
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Vous êtes connecté à votre espace personnel.');
    }

    public function create(array $data)
    {
      $user = User::create([
       'name' => $data['name'],
       'role' => $data['role'], 
         'prenom' => $data['prenom'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),

      ]);

     // Auth::login($user);
      return redirect("dashboard")->withSuccess('compte utilisateur crée avec succes');
    }    
    
    public function documents()
    {
        if(Auth::check()){
            return view('document');
        }
  
        return redirect("login")->withSuccess('Acces restreint');
    }

    public function dashboard()
    {


    if(!Auth::check()){
        return redirect("login")->withSuccess('Acces restreint');
    }

    
    
      
    
    
    
        
       
      //  return view('welcome', $data);
    $user = Auth::user();
    $user_id = $user->id;
    $is_admin = 0;
    $is_admin = $user->is_admin;

    if($is_admin==1){
            

            $demandes = DB::table('demandes')
            ->select('*')  
        // ->where('user_id', '=',  $user_id)
            ->orderBy('id', 'desc')
            ->get();
    
    }else{

/*
        $demandes = DB::table('demandes')
        ->select('*')  
        ->where('user_id', '=',  $user_id)
        ->orderBy('id', 'desc')
        ->get();*/

       // echo 'dashboard';exit;


    }
   /* foreach($demandes as $d){
            $d->updated_at = date('d/m/Y', strtotime($d->updated_at));
    }*/
    $demandes ='';

     /* $appointments = CrudEvents::whereDate('event_start', '>=', $request->start)
                ->whereDate('event_end',   '<=', $request->end)
                ->get(['id', 'event_name', 'event_start', 'event_end']);*/
        
                $appointments = DB::table('crud_events')
                ->where('id_user', '=',  $user_id)
                ->get();

                foreach($appointments as $d){
                   
             /*   if($d->intervention_id){

                    $intervention = Interventions::find($d->intervention_id);
                    if($intervention->usager_id != 0){
                        $usager_name = DB::table('usagers')->where('id', '=', $intervention->usager_id)->first()->nom;
                    }
                    $categorie = DB::table('interventions_categorie')->where('id', '=', $intervention->id_interventions_categorie)->first()->nom; 
                   
                    $current_name = $categorie.' - '.$usager_name .$d->event_name;
                   
                    $d->event_name = $current_name;
                  
                }*/

            }
       
    
        $data["appointments"] = $appointments;
    



    if($is_admin == 0){
        $data = [
            'demandes' => $demandes ,
            'appointments' => $appointments
        ];

        return  view('dashboard')->with($data);
    }else{

        $data = [
            'demandes' => $demandes,
            'is_admin' => $is_admin,
            'appointments' => $appointments
        ];
        return  view('dashboard')->with($data);
        //return  view('admin.dashboard_admin')->with($data);
    }
       
    


    
    
}
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function listes ()
    {
            
        $data["resultats"] =DB::table('resultats')->get();
        $data["ages"] =DB::table('ages')->get();
        $data["categories_sociopro"] =DB::table('categories_sociopro')->get();
        $data["interventions_categorie"] =DB::table('interventions_categorie')->get();
        $data["organismes"] =DB::table('organismes')->get();
        $data["postes"] =DB::table('postes')->get();
        $data["quartiers"] =DB::table('quartiers')->get();
        $data["sous_thematiques"] =DB::table('sous_thematiques')->get();
        $data["thematiques"] =DB::table('thematiques')->get();
        $data["types_intervention"] =DB::table('types_intervention')->get();

        return view('listes-statiques', $data);
    }
}