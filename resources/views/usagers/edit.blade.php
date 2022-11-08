@extends('template')
@section('contenu')

<div>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('usagers.create') }}"  class="btn btn-primary">Créer usager</a>
	</div>
<form method="POST" action="{{ route('usagers.update',$usagers->id) }}" enctype="multipart/form-data" >

		<!-- Le token CSRF -->
		@csrf
		
		<div  class="form-group">
			<label for="nom" >Nom</label><br/>
			<input type="text" name="nom" value="{{ $usagers->nom }}"  id="nom" placeholder="Nom"   class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("nom")
			<div>{{ $message }}</div>
			@enderror
		</div>
		<div  class="form-group">
			<label for="prenom" >Prénom</label><br/>
			<input type="text" name="prenom" value="{{ $usagers->prenom }}"  id="prenom" placeholder="Prénom"   class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("prenom")
			<div>{{ $message }}</div>
			@enderror
		</div>
	
		<div  class="form-group">
			<input type="submit" name="valider" value="Valider"  class="btn btn-primary">
		</div>
	</form>


@endsection
