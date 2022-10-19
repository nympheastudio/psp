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
      <th scope="col" style=" width:5%">Type</th>
      <th scope="col" style=" width:5%">Statut</th>
      <th scope="col" style=" width:5%">Categorie</th>
	  <th scope="col" style=" width:5%">Thème</th>
      
	  <th scope="col"style=" width:7%">Sous thème</th>
	  <th scope="col"style=" width:7%">Usager</th>
	  <th scope="col"style=" width:7%">Quartier</th>
	  <th scope="col"style=" width:7%">Cat socioPro</th>
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
				
				{{ $u->categorie }}
</td>
<td>
				{{$u->thematique}}
			</td>
			<td>
				{{ $u->sous_thematique }}
			</td>
			
				<td>
					<a href="{{ route('interventions.show', $u) }}" title="Lire l'article" >{{ $u->genre }} {{ $u->nom_beneficiaire }} {{ $u->age }}</a>
				</td>
				<td>
{{ $u->quartier }}
</td>
<td>
{{ $u->categorie_sociopro }}
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
	<div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red" href="https://psp.facevaucluse.com/interventions/create">
        <i class="large material-icons">+</i>
    </a>
    <!-- <ul>
        <li>
            <a id="first-fab" class="btn-floating" data-fabcolor="#45d1ff" href="https://psp.facevaucluse.com/create-event">
                <i class="material-icons">Créer un RDV</i>
            </a>
        </li>
       <li>
            <a id="second-fab" class="btn-floating" data-fabcolor="#7345ff">
                <i class="material-icons">format_quote</i>
            </a>
        </li>
        <li>
            <a id="third-fab" class="btn-floating" data-fabcolor="#0084ff">
                <i class="material-icons">publish</i>
            </a>
        </li>
        <li>
            <a id="fourth-fab" class="btn-floating" data-fabcolor="#ff7345">
                <i class="material-icons">attach_file</i>
            </a>
        </li>
    </ul>-->
</div>
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
