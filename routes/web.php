<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Connection;

use App\Http\Controllers\CalenderController;


use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\DossiersController;
use App\Http\Controllers\InterventionsController;

//use App\Http\Controllers\FileManagerController;



Route::get('/', [CustomAuthController::class, 'index']);

Route::get('documents', [CustomAuthController::class, 'documents']); 

Route::get('reportings', [InterventionsController::class, 'reportings'])->name('interventions.reportings');
Route::post('reportings-export', [InterventionsController::class, 'reportingsExport'])->name('interventions.reportingsExport');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('users', [CustomAuthController::class, 'users'])->name('users');
Route::get('listes', [CustomAuthController::class, 'listes'])->name('listes');
Route::get('users/{user}/edit', [CustomAuthController::class, 'edit'])->name('users.edit');
Route::delete('users/{user}', [CustomAuthController::class, 'destroy'])->name('users.destroy');

Route::get('agenda');
Route::get('calendar-event', [CalenderController::class, 'index']);
Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);
Route::get('create-event', [CalenderController::class, 'createEvent']);
Route::post('create-event', [CalenderController::class, 'saveEvent']);
Route::get('agenda-global', [CalenderController::class, 'agendaGlobal']);


Route::get('usagers', [UsagersController::class, 'index'])->name('usagers.index');
Route::get('usagers/create', [UsagersController::class, 'create'])->name('usagers.create');
Route::post('usagers', [UsagersController::class, 'store'])->name('usagers.store');
Route::get('usagers/{usager}', [UsagersController::class, 'show'])->name('usagers.show');
Route::get('usagers/{usager}/edit', [UsagersController::class, 'edit'])->name('usagers.edit');
Route::post('usagers/{usager}.update', [UsagersController::class, 'update'])->name('usagers.update');
Route::delete('usagers/{usager}', [UsagersController::class, 'destroy'])->name('usagers.destroy');






Route::get('dossiers', [DossiersController::class, 'index'])->name('dossiers.index');
Route::get('dossiers/create', [DossiersController::class, 'create'])->name('dossiers.create');
Route::post('dossiers', [DossiersController::class, 'store'])->name('dossiers.store');
Route::get('dossiers/{dossier}', [DossiersController::class, 'show'])->name('dossiers.show');
Route::get('dossiers/{dossier}/edit', [DossiersController::class, 'edit'])->name('dossiers.edit');
Route::post('dossiers/{dossier}/update', [DossiersController::class, 'update'])->name('dossiers.update');
Route::delete('dossiers/{dossier}', [DossiersController::class, 'destroy'])->name('dossiers.destroy');

Route::get('interventions', [InterventionsController::class, 'index'])->name('interventions.index');
Route::get('interventions/create', [InterventionsController::class, 'create'])->name('interventions.create');
Route::post('interventions', [InterventionsController::class, 'store'])->name('interventions.store');
Route::get('interventions/{intervention}', [InterventionsController::class, 'show'])->name('interventions.show');
Route::get('interventions/{intervention}/edit', [InterventionsController::class, 'edit'])->name('interventions.edit');
Route::post('interventions/{intervention}/update', [InterventionsController::class, 'update'])->name('interventions.update');
Route::delete('interventions/{intervention}', [InterventionsController::class, 'destroy'])->name('interventions.destroy');




Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
	\UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('refresh-csrf', function(){
    return csrf_token();
});


Route::get("/test", function(){
	
	// Test database connection
	// try {
		// DB::connection()->getPdo();
		// echo "Connected successfully to: " . DB::connection()->getDatabaseName();
		// } catch (\Exception $e) {
			// die("Could not connect to the database. Please check your configuration. error:" . $e );
			// }
			
			$idAccueillant = 1973;
			
			$rdv_festifs = DB::table('BONS_PLANS')
			->where('ID_ACCUEILLANT', $idAccueillant)
			->where('ETAT_MODERATION', 1)
			->where('DATE_FIN', '>=', date("Y-m-d"))
			->get();//->first();
			
			
			$r ='';
			
			foreach ($rdv_festifs as $rdv) {
				$r.= $rdv->TITRE."\n";
			}
			
			
			//$requete = $dbLink->query('SELECT ID FROM BONS_PLANS WHERE ID_ACCUEILLANT = ' . $idAccueillant . ' AND ETAT_MODERATION = 1 AND DATE_FIN >= NOW() ORDER BY DATE_DEBUT ASC;');
			if ($r!='') {
				
				return $r;
				
			}else{ 
				
				return 'Pas de RDVs';
			}
			
			
			
			
		});