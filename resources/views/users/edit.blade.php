@extends('template')
@section('contenu')


<form method="POST" action="{{ route('users.edit',$user->id) }}" enctype="multipart/form-data" >

		<!-- Le token CSRF -->
		@csrf

		<div class="form-group mb-3">
                                <select name="role" id="role" class=" form-select">
                                     <option value="mediateur" 
									@if($user->role == 'mediateur')
										selected
									@endif
									>Médiateur</option>
                                    <option value="admin"
									@if($user->role == 'admin')
										selected
									@endif
									>Administrateur</option>
                                </select>
                            </div>
		
		<div  class="form-group">
			<label for="nom" >Nom</label><br/>
			<input type="text" name="nom" value="{{ $user->name }}"  id="nom" placeholder="Nom"   class="form-control">

			<!-- Le message d'erreur pour "title" -->
			@error("nom")
			<div>{{ $message }}</div>
			@enderror
		</div>
		<div  class="form-group">
			<label for="prenom" >Prénom</label><br/>
			<input type="text" name="prenom" value="{{ $user->prenom }}"  id="prenom" placeholder="Prénom"   class="form-control">

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
