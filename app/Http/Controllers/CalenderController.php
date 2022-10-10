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
    $a->id_user = DB::table('users')->where('id', '=', $a->id_user)->first()->name;
}


        $data = [
           // 'demandes' => $demandes ,
         
            'appointments' => $appointments
        ];

        
        return view('agenda-global',$data);
    }

    public function createEvent(Request $request)
    {
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
            'event_end' => 'required',
            'user_id' => 'required',
        ]);
        $event = new CrudEvents();
        $event->event_name = $request->event_name;
        $event->event_start = $request->event_start;
        $event->event_end = $request->event_end;
        $event->id_user = $request->user_id;
        $event->url = $request->event_url;
        $event->intervention_id = $request->intervention_id;
        $event->save();
        return redirect()->route('dashboard')->with('success', 'Event created successfully.');
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