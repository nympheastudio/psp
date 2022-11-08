@extends('template')
@section('entete')


   

@endsection
@section('contenu')
<div class="container">
@if(session()->has('error'))
    <div class="alert alert-error">
        {{ session()->get('error') }}
    </div>
@endif
<form method="POST" action="https://psp.facevaucluse.com/create-event">
@csrf
<div class="form-group">
<label for="title">Titre</label>
<input type="text" class="form-control" id="title" name="event_name" placeholder="Titre" value="{{ old('event_name') }}">

</div>
<div class="form-group">
<label for="start">Date de début</label>
<input type="datetime-local" class="form-control" id="start" name="event_start" placeholder="Date de début" value="{{ old('event_start') }}">

</div>
<div class="form-group">
<label for="end">Date de fin</label>
<input type="datetime-local" class="form-control" id="end" name="event_end" placeholder="Date de fin" value="{{ old('event_end') }}">

</div>

<div class="form-group">
<label for="url">Poste</label>    
<select class="form-select" id="poste" name="poste">
<option value="0">Sélectionner un poste</option>

  @foreach($postes as $poste)
 
  <option 
  @if (old('poste') == $poste->id) selected @endif

  value="{{$poste->id}}">
  {{$poste->nom}}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<label for="url">URL</label>    
<input type="text" class="form-control" id="url" name="event_url" placeholder="URL">

</div>

<div class="form-group">
<label for="user">Utilisateur</label>
<select class="form-select" id="user" name="user_id">
@if (Auth::user()->role == 'mediateur' )
<option value="{{Auth::user()->id}}">Moi ({{Auth::user()->name}})</option>
@endif

@foreach($users as $user)
<option value="{{$user->id}}">{{$user->name}}</option>
@endforeach

</select>
</div>


  <div class="form-group">
      <label for="intervention">lier à une intervention existante :</label>


      <input id="intervention" name="intervention" type="text" list="intervention_datalist" class="form-select" placeholder="Lier à une intervention existante">
      <datalist id="intervention_datalist">
          @foreach($interventions as $intervention)
          <option rel="{{$intervention->id}}" value="{{$intervention->usager}} {{$intervention->categorie}} {{$intervention->user}}" >
          @endforeach
      </datalist>



      <input type="hidden" name="intervention_id" id="intervention_id" value="">
      
      <span id="error" class="text-danger"></span>
  </div>


<button type="submit" class="btn btn-primary">Ajouter</button>
</form>


</div>
<script>
  /* const loaderContainer = document.querySelector('.loader-container');
  
  window.addEventListener('load', () => {
    loaderContainer.classList.add('fade-out');
  });*/
  


  
  $(document).ready(function(){
    $("#intervention").on('input', function () {
    var val = this.value;
    if($('#intervention_datalist option').filter(function(){
        return this.value.toUpperCase() === val.toUpperCase();        
    }).length) {
        //send ajax request
        //alert(this.value);
        let rel = $('#intervention_datalist option[value="'+this.value+'"]').attr('rel');
        //alert(rel);
        $('#intervention_id').val(rel);
    }
});
  });
  </script>
    @endsection
