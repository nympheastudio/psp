@extends('template')
@section('contenu')
<a class="fab-button fab-toggle" alt="Créer intervention"><i class="fas fa-plus"></i></a>
<p>
		<a href="{{ route('interventions.create') }}"  >Créer intervention</a>
	</p>
    <table class="table table-hover table-sm"  id="liste_interventions" style="font-size:12px">
  <thead>
    <tr>
      <th scope="col" style="width:2%">id</th>
      <th scope="col" style=" width:5%">type intervention</th>
      <th scope="col" style=" width:5%">resultat</th>
      <th scope="col" style=" width:5%">categorie</th>
      <th scope="col"style=" width:7%">nom</th>
      <th scope="col" style=" width:17%">Actions</th>
    </tr>
  </thead>
 
		<tbody>
			@foreach ($interventions as $u)
			<tr>
			<td>
				{{ $u->id }}	
			</td>
			<td>
				{{ $u->type_intervention }}	
			</td>
			<td>
				{{ $u->resultat }}	
			</td>
			<td>
				{{ DB::table('interventions_categorie')->find($u->id_interventions_categorie)->nom }}
			</td>
			
				<td>
					<a href="{{ route('interventions.show', $u) }}" title="Lire l'article" >{{ App\Models\Usagers::getNamebyId($u->usager_id) }}</a>
				</td>
				<td>
					<a href="{{ route('interventions.edit', $u) }}" title="Modifier l'article" >Modifier</a>
				
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('interventions.destroy', $u) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
						<input type="submit" value="x Supprimer" >
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<script type="text/javascript">
$(document).ready(function(){


	$('#liste_interventions').DataTable({
  "language": {
    "sProcessing": "Traitement en cours ...",
    "sLengthMenu": "Afficher _MENU_ lignes",
    "sZeroRecords": "Aucun résultat trouvé",
    "sEmptyTable": "Aucune donnée disponible",
    "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
    "sInfoEmpty": "Aucune ligne affichée",
    "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
    "sInfoPostFix": "",
    "sSearch": "Chercher:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Chargement...",
    "oPaginate": {
      "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
    },
    "oAria": {
      "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
    }
  }
});
});
</script>
@endsection
