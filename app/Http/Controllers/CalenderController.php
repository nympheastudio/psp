<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\CrudEvents;
use DB;
use Input;
//use File;
use ZipArchive;
use App\Models\Interventions;
use App\Models\Usagers;

class CalenderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {  
            $data = CrudEvents::whereDate('event_start', '>=', $request->start)
            ->whereDate('event_end',   '<=', $request->end)
            ->get(['id', 'event_name', 'event_start', 'event_end']);
            return response()->json($data);
        }
        
        
        return view('welcome');
    }
    
    public function agendaGlobal(Request $request)
    {
        $appointments = DB::table('crud_events')->get();
        $data["users"] = DB::table('users')->get();
        
        foreach($appointments as $a){
            $a->params =  DB::table('users')->where('id', '=', $a->id_user)->first()->params;
            $p = explode( ',', $a->params)[0];
            if($p)$a->bgcolor = explode(':', $p)[1];
            
            $a->id_user = DB::table('users')->where('id', '=', $a->id_user)->first()->name;
            
        }
        
        foreach($data["users"] as $u){
            
            $u->bgcolor = 'red';
            
            $p = explode( ',', $u->params)[0];
            
            if($p)$u->bgcolor = explode(':', $p)[1];
        }
        
        
        $data = [
            // 'demandes' => $demandes ,
            'users' => $data["users"],
            'appointments' => $appointments
        ];
        
        
        return view('agenda-global',$data);
    }
    
    public function createEvent(Request $request)
    {
        
        $data["postes"] = DB::table('postes')->get();
        $data["users"] = DB::table('users')->get();
        $interventions = DB::table('interventions')->get();
        
        foreach($interventions as $i){
            $i->user = DB::table('users')->where('id', '=', $i->id_user)->first()->name;
            $i->usager = DB::table('usagers')->where('id', '=', $i->usager_id)->first()->nom;
            $i->categorie = DB::table('interventions_categorie')->where('id', '=', $i->id_interventions_categorie)->first()->nom;
        } 
        
        $data["interventions"] = $interventions;
        
        
        return view('create-event',$data);
    }
    
    public function saveEvent(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_start' => 'required',
            //  'event_end' => 'required',
            'user_id' => 'required',
        ]);
        $event = new CrudEvents();
        $event->event_name = $request->event_name;
        $event->event_start = $request->event_start;
        
        $event_start =  date('Y-m-d H:i:s', strtotime($request->event_start ));
        $event_start_plus_onehour = date('Y-m-d H:i:s', strtotime($request->event_start . ' +1 hour'));
        
        if(!$request->event_end){
            $event->event_end = $event_start_plus_onehour;
        }else{
            $event->event_end = $request->event_end;
        }
        $event->id_user = $request->user_id;
        $event->url = $request->event_url;
        $event->intervention_id = $request->intervention_id;
        $event->poste = $request->poste;

        $username = DB::table('users')->where('id', '=', $request->user_id)->first()->name;
        
        
        if($request->intervention_id){
            $intervention = Interventions::find($request->intervention_id);
            $usager_name = DB::table('usagers')->where('id', '=', $intervention->usager_id)->first()->nom;
            $categorie = DB::table('interventions_categorie')->where('id', '=', $intervention->id_interventions_categorie)->first()->nom; 
            
            
            $poste = DB::table('postes')->where('id', '=', $request->poste)->first()->nom;
            
            $event->event_name =  $categorie. ' / '.$usager_name . ' / ' .$request->event_name .  ' / Poste :' . $poste;
            
        }
        
        //verify if poste is booked beetween event_start and event_end
        
        $poste = DB::table('crud_events')
        ->where('poste', '=', $request->poste)
        ->whereRaw(
            "((event_start >= ? AND event_start <= ? )OR( event_end >= ? AND event_end <= ?))", 
            [
                $event->event_start, 
                $event->event_end,
                $event->event_start, 
                $event->event_end
                ]
                )
                
                ->get();
                
                
                
                
                //echo $request->poste. '<br>';
                //
                //echo $event_start .'<br>';
                ////  echo $event->event_start .'<br>';
                //echo $event->event_end .'<br>';
                
                if(  $poste->count() > 0){
                  // echo  'Ce Poste est déjà réservé à cette heure et date !<br>';
                  // 
                  // foreach($poste as $p){
                  //     echo '<br><u>Réservations : </u><br>';
                  //     echo $p->id .'<br>';
                  //     echo $p->event_start .'<br>';
                  //     echo $p->event_end .'<br><hr>';
                  // }

                  return redirect()->back()->withInput()->with('error', 'Poste deja réservé à cette date et heure !');
                }
                
               
                $event->save();
                return redirect()->route('dashboard')->with('success', 'RDV pour '.$username.' créé avec succès !');
            }
            
            public function calendarEvents(Request $request)
            {
                
                switch ($request->type) {
                    case 'create':
                        $event = CrudEvents::create([
                            'event_name' => $request->event_name,
                            'event_start' => $request->event_start,
                            'event_end' => $request->event_end,
                        ]);
                        
                        return response()->json($event);
                        break;
                        
                        case 'edit':
                            $event = CrudEvents::find($request->id)->update([
                                'event_name' => $request->event_name,
                                'event_start' => $request->event_start,
                                'event_end' => $request->event_end,
                            ]);
                            
                            return response()->json($event);
                            break;
                            
                            case 'delete':
                                $event = CrudEvents::find($request->id)->delete();
                                
                                return response()->json($event);
                                break;
                                
                                default:
                                # ...
                                break;
                            }
                        }
                    }