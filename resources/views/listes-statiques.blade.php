@extends('template')
@section('contenu')
<h1>Listes statiques *</h1>

<h2>Résultats : </h2>
@foreach ($resultats as $r)
	{{ $r->statut}}<br>
@endforeach
<br><hr>

<h2>Ages : </h2>
@foreach ($ages as $a)
	{{ $a->nom}}<br>
@endforeach
<br><hr>


<h2>Catégories sociopro : </h2>
@foreach ($categories_sociopro as $c)
	{{ $c->nom}}<br>
@endforeach
<br><hr>

<h2>Interventions catégorie : </h2>
@foreach ($interventions_categorie as $i)
	{{ $i->nom}}<br>
@endforeach

<br><hr>

<h2>Organismes : </h2>
@foreach ($organismes as $o)
	{{ $o->organisme}}<br>
@endforeach

<br><hr>

<h2>Postes : </h2>
@foreach ($postes as $p)
	{{ $p->poste}}<br>
@endforeach

<br><hr>

<h2>Quartiers : </h2>
@foreach ($quartiers as $q)
	{{ $q->nom}}<br>
@endforeach

<br><hr>
<h2>Thématiques : </h2>
@foreach ($thematiques as $t)
	{{ $t->nom}}<br>
@endforeach

<br><hr>
<h2>Sous thématiques : </h2>

@foreach ($sous_thematiques as $s)
	{{ $s->nom}} (id parent: {{ $s->id_parent}}) <br>
@endforeach

<br><hr>

<h2>Type intervention : </h2>	
@foreach ($types_intervention as $t)
	{{ $t->nom}}<br>
@endforeach

<br><hr>


<h5> * : Editable par nymphea</h5>


	
	
	<script type="text/javascript">
$(document).ready(function(){


});
</script>
@endsection
