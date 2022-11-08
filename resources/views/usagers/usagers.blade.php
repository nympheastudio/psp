@extends('template')
@section('contenu')

<p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('usagers.create') }}"  class="btn btn-primary">Créer usager</a>
	</p>
	<table class="table table-hover datatable "  id="liste_usagers" >
  <thead>
    <tr>
      
      <th scope="col" style=" width:15%">Nom</th>
	  <th scope="col" style=" width:15%">Prénom</th>
	  <th scope="col" style=" width:5%">Genre</th>
	  <th scope="col" style=" width:5%">Age</th>
	  <th scope="col" style=" width:15%">Quartier</th>

      <th scope="col" style=" width:27%">Actions</th>
    </tr>
  </thead>

		<tbody>
			<!-- On parcourt la collection de Post -->
			@foreach ($usagers as $u)
			<tr>
				<td>
					<!-- Lien pour afficher un Post : "posts.show" -->
					<a href="{{ route('usagers.show', $u) }}" title="Lire l'article" >{{ $u->nom }}</a>
				</td>
				<td>{{ $u->prenom }}</td>
				<td>{{ $u->genre }}</td>
				<td>{{ $u->age }}</td>
				<td>{{ $u->quartier }}</td>
				<td>
					<!-- Lien pour modifier un Post : "posts.edit" -->
					<a href="{{ route('usagers.edit', $u) }}" title="Modifier l'article" class="btn btn-secondary">Modifier</a>
				</td>
				<td>
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('usagers.destroy', $u) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
						<input type="submit" value="Supprimer"  class="btn btn-secondary" >
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
