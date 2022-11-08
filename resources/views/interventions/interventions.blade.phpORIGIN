@extends('template')
@section('contenu')


    <table class="table table-hover datatable "  id="liste_interventions" >
  <thead>
    <tr>
      <th scope="col" style="width:2%">id</th>
      <th scope="col" style=" width:7%">Type</th>
      <th scope="col" style=" width:6%">Statut</th>
      <th scope="col" style=" width:5%">Categorie</th>
	  <th scope="col" style=" width:5%">Thème</th>
      
	  <th scope="col"style=" width:7%">Sous thème</th>
	  <th scope="col"style=" width:10%">Usager</th>
	  <th scope="col"style=" width:10%">Quartier</th>
	  <th scope="col"style=" width:10%">Cat socioPro</th>
      <th scope="col" style=" width:7%">Actions</th>
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
				<td class="text-center">
        <a href="{{ route('interventions.edit', $u) }}" title="Modifier l'article"   class="btn"> <i class="bi bi-pencil-square"></i><div class="label">Modifier</div></a>
				
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('interventions.destroy', $u) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
           
						<button type="submit" class="btn">
            <i class="bi bi-trash"></i><div class="label">Supprimer</div>
          </button>
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


	
});
</script>
@endsection
