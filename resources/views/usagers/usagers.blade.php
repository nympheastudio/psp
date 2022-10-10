@extends('template')
@section('contenu')

<p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('usagers.create') }}"  >Créer usager</a>
	</p>
	<table class="table table-hover table-sm"  id="liste_interventions" style="font-size:12px">
  <thead>
    <tr>
      
      <th scope="col" style=" width:5%">Nom</th>

      <th scope="col" style=" width:17%">Actions</th>
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
				<td>
					<!-- Lien pour modifier un Post : "posts.edit" -->
					<a href="{{ route('usagers.edit', $u) }}" title="Modifier l'article" >Modifier</a>
				</td>
				<td>
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('usagers.destroy', $u) }}" >
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
