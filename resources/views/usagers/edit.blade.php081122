@extends('template')
@section('contenu')

<p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('usagers.create') }}"  >Créer usager</a>
	</p>
<form method="POST" action="{{ route('usagers.update',$usagers->id) }}" enctype="multipart/form-data" >

		<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="nom" >Nom</label><br/>
			<input type="text" name="nom" value="{{ $usagers->nom }}"  id="nom" placeholder="Nom" >

			<!-- Le message d'erreur pour "title" -->
			@error("nom")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<label for="prenom" >Prénom</label><br/>
			<input type="text" name="prenom" value="{{ $usagers->prenom }}"  id="prenom" placeholder="Prénom" >

			<!-- Le message d'erreur pour "title" -->
			@error("prenom")
			<div>{{ $message }}</div>
			@enderror
		</p>
	

		<input type="submit" name="valider" value="Valider" >

	</form>


@endsection
