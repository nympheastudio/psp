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
			@if( $u->resultat == 'en cours')
				<span class="badge badge-warning">{{ $u->resultat }}</span>
				@elseif( $u->resultat == 'réglé')
				<span class="badge badge-success">{{ $u->resultat }}</span>
				@elseif( $u->resultat == 'Annulée')
				<span class="badge badge-danger">{{ $u->resultat }}</span>
				@else
				<span class="badge badge-info">{{ $u->resultat }}</span>
				@endif
			
				<!--
					<span class="badge badge-primary">Primary</span>
<span class="badge badge-secondary">Secondary</span>
<span class="badge badge-success">Success</span>
<span class="badge badge-danger">Danger</span>
<span class="badge badge-warning">Warning</span>
<span class="badge badge-info">Info</span>
<span class="badge badge-light">Light</span>
<span class="badge badge-dark">Dark</span>-->
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
					<a href="{{ route('interventions.edit', $u) }}" title="Lire l'article" >{{ $u->genre }} {{ $u->nom_beneficiaire }} {{ $u->age }}</a>
				</td>
				<td>
{{ $u->quartier }}
</td>
<td>
{{ $u->categorie_sociopro }}
</td>
				<td class="text-center">
        			<p><a href="{{ route('interventions.edit', $u) }}" title="Modifier l'article" class="btn btn-secondary">Modifier</a></p>
				
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('interventions.destroy', $u) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
           
						<button type="submit" class="btn btn-secondary"><div class="label">Supprimer</div></button>
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

</div>
	<script type="text/javascript">
$(document).ready(function(){


	
});
</script>
@endsection
