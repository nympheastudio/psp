@extends('template')
@section('contenu')

<p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a  href="https://psp.facevaucluse.com/registration" class="btn btn-primary" >Créer utilisateur</a>
	</p>
	<table class="table table-hover table-sm"  id="liste_users" style="font-size:12px">
  <thead>
    <tr>
      
      <th scope="col" width="10%" >Nom</th>
	  <th scope="col"width="10%" >Prénom</th>
	  <th scope="col" width="10%" >Email</th>
	  <th scope="col"  width="10%">Role</th>
      <th scope="col" width="10%">Actions</th>
	
    </tr>
  </thead>

		<tbody>
			<!-- On parcourt la collection de Post -->
			@foreach ($users as $u)
			<tr>
				<td>{{ $u->name }}</td>
				<td>{{ $u->prenom }}</td>
				<td>{{ $u->email }}</td>
				

				<td><span class="badge @if($u->role == 'admin')badge-primary @else badge-warning @endif">{{ $u->role }}</span></td>
				<td>
					<!-- Lien pour modifier un Post : "posts.edit" -->
					<p><a href="{{ route('users.edit', $u) }}" title="Modifier l'utilisateur" class="btn btn-secondary">Modifier</a></p>
				
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('users.destroy', $u) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
						<input type="submit" value="Supprimer" class="btn btn-secondary">
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
