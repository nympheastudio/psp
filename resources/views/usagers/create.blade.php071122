@extends('template')
@section('contenu')


<form method="POST" action="{{ route('usagers.store') }}" enctype="multipart/form-data" >

		<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="categorie_sociopro" >Catégorie socioprofessionnelle</label><br/>
			<select name="categorie_sociopro" >
				<option>Sélectionner une catégorie</option>
			@foreach ($categories_sociopro as $c)
	<option value="{{ $c->id}}">{{ $c->nom}}</option>
@endforeach
</select>
		</p>
		<p>
			<label for="age" >Date de naissance</label><br/>
			<input name="dob" type="date" value="{{ old('dob') }}" />
		</p>
<p>
<label for="genre" >Genre</label><br/>
<select name="genre" id="genre">
<option>Sélectionner un genre</option>
<option value="mr">Monsieur</option>
<option value="mme">Madame</option>

</select>
</p>
		<p>
			<label for="nom" >Nom</label><br/>
			<input type="text" name="nom" value="{{ old('nom') }}"  id="nom" placeholder="Nom" >

			<!-- Le message d'erreur pour "title" -->
			@error("nom")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<label for="prenom" >Prénom</label><br/>
			<input type="text" name="prenom" value="{{ old('prenom') }}"  id="prenom" placeholder="Prénom" >

			<!-- Le message d'erreur pour "title" -->
			@error("prenom")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<!-- 
nom_naissance, adresse, cp, ville, tel , num_secu, num_alloc, categorie_sociopro, autre
-->
	<p>
			<label for="nom_naissance" >Nom de naissance</label><br/>
			<input type="text" name="nom_naissance" value="{{ old('nom_naissance') }}"  id="nom_naissance" placeholder="Nom de naissance" >

			<!-- Le message d'erreur pour "title" -->
			@error("nom_naissance")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<p>
			<label for="quartier" >Quartier</label><br/>
			<select name="quartier" >
				<option>Sélectionner un quartier</option>
			@foreach ($quartiers as $q)
	<option value="{{ $q->id}}">{{ $q->nom}} {{ $q->code_postal}}</option>
@endforeach
</select>
		<p>
			<label for="adresse" >Adresse</label><br/>
			<input type="text" name="adresse" value="{{ old('adresse') }}"  id="adresse" placeholder="Adresse" >

			<!-- Le message d'erreur pour "title" -->
			@error("adresse")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<p>
			<label for="cp" >Code postal</label><br/>
			<input type="text" name="cp" value="{{ old('cp') }}"  id="cp" placeholder="Code postal" >

			<!-- Le message d'erreur pour "title" -->
			@error("cp")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<p>
			<label for="ville" >Ville</label><br/>
			<input type="text" name="ville" value="{{ old('ville') }}"  id="ville" placeholder="Ville" >

			<!-- Le message d'erreur pour "title" -->
			@error("ville")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<p>
			<label for="tel" >Téléphone</label><br/>
			<input type="text" name="tel" value="{{ old('tel') }}"  id="tel" placeholder="Téléphone" >

			<!-- Le message d'erreur pour "title" -->
			@error("tel")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<p>
			<label for="num_secu" >Numéro de sécurité sociale</label><br/>
			<input type="text" name="num_secu" value="{{ old('num_secu') }}"  id="num_secu" placeholder="Numéro de sécurité sociale" >

			<!-- Le message d'erreur pour "title" -->
			@error("num_secu")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<p>
			<label for="num_alloc" >Numéro d'allocation</label><br/>
			<input type="text" name="num_alloc" value="{{ old('num_alloc') }}"  id="num_alloc" placeholder="Numéro d'allocation" >

			<!-- Le message d'erreur pour "title" -->
			@error("num_alloc")
			<div>{{ $message }}</div>
			@enderror

		</p>

		

		<p>
			<label for="autre" >Autre</label><br/>
			<input type="text" name="autre" value="{{ old('autre') }}"  id="autre" placeholder="Autre" >

			<!-- Le message d'erreur pour "title" -->
			@error("autre")
			<div>{{ $message }}</div>
			@enderror
		</p>


		<input type="submit" name="valider" value="Valider" >

	</form>


@endsection
