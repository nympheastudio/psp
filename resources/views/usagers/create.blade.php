@extends('template')
@section('contenu')


<form method="POST" action="{{ route('usagers.store') }}" enctype="multipart/form-data" id="create_usager_form" >

		<!-- Le token CSRF -->
		@csrf
		
		<div class="form-group">
			<label for="categorie_sociopro" >Catégorie socioprofessionnelle</label><br/>
			<select name="categorie_sociopro"  class="form-select">
				<option>Sélectionner une catégorie</option>
			@foreach ($categories_sociopro as $c)
				<option value="{{ $c->id}}">{{ $c->nom}}</option>
			@endforeach
			</select>
		</div>
		<div  class="form-group">
			<label for="age" >Date de naissance</label><br/>
			<input name="dob" type="date" value="{{ old('dob') }}"  class="form-control" />
		</div>
		<div  class="form-group">
			<label for="genre" >Genre</label><br/>
			<select name="genre" id="genre"  class="form-select">
			<option>Sélectionner un genre</option>
			<option value="mr">Monsieur</option>
			<option value="mme">Madame</option>

			</select>
		</div>
		<div  class="form-group">
			<label for="nom" >Nom</label><br/>
			<input type="text" name="nom" value="{{ old('nom') }}"  id="nom" placeholder="Nom"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("nom")
			<div>{{ $message }}</div>
			@enderror
		</div>
		<div  class="form-group">
			<label for="prenom" >Prénom</label><br/>
			<input type="text" name="prenom" value="{{ old('prenom') }}"  id="prenom" placeholder="Prénom"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("prenom")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<!-- 
nom_naissance, adresse, cp, ville, tel , num_secu, num_alloc, categorie_sociopro, autre
-->
		<div  class="form-group">
			<label for="nom_naissance" >Nom de naissance</label><br/>
			<input type="text" name="nom_naissance" value="{{ old('nom_naissance') }}"  id="nom_naissance" placeholder="Nom de naissance"  class="form-control" >

			<!-- Le message d'erreur pour "title" -->
			@error("nom_naissance")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<div  class="form-group">
			<label for="quartier" >Quartier</label><br/>
			<select name="quartier"  class="form-select">
				<option>Sélectionner un quartier</option>
			@foreach ($quartiers as $q)
				<option value="{{ $q->id}}">{{ $q->nom}} {{ $q->code_postal}}</option>
			@endforeach
			</select>
		<div  class="form-group">
			<label for="adresse" >Adresse</label><br/>
			<input type="text" name="adresse" value="{{ old('adresse') }}"  id="adresse" placeholder="Adresse"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("adresse")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<div  class="form-group">
			<label for="cp" >Code postal</label><br/>
			<input type="text" name="cp" value="{{ old('cp') }}"  id="cp" placeholder="Code postal"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("cp")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<div  class="form-group">
			<label for="ville" >Ville</label><br/>
			<input type="text" name="ville" value="{{ old('ville') }}"  id="ville" placeholder="Ville"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("ville")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<div  class="form-group">
			<label for="tel" >Téléphone</label><br/>
			<input type="text" name="tel" value="{{ old('tel') }}"  id="tel" placeholder="Téléphone"  class="form-control" >

			<!-- Le message d'erreur pour "title" -->
			@error("tel")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<div  class="form-group">
			<label for="num_secu" >Numéro de sécurité sociale</label><br/>
			<input type="text" name="num_secu" value="{{ old('num_secu') }}"  id="num_secu" placeholder="Numéro de sécurité sociale"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("num_secu")
			<div>{{ $message }}</div>
			@enderror
		</div>

		<div  class="form-group">
			<label for="num_alloc" >Numéro d'allocation</label><br/>
			<input type="text" name="num_alloc" value="{{ old('num_alloc') }}"  id="num_alloc" placeholder="Numéro d'allocation"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("num_alloc")
			<div>{{ $message }}</div>
			@enderror

		</div>

		

		<div  class="form-group">
			<label for="autre" >Autre</label><br/>
			<input type="text" name="autre" value="{{ old('autre') }}"  id="autre" placeholder="Autre"  class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("autre")
			<div>{{ $message }}</div>
			@enderror
		</div>
		<div  class="form-group">
			<input type="submit" name="valider" value="Valider" class="btn btn-primary" >
		</div>



	</form>


@endsection
