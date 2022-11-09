@extends('template')
@section('contenu')

<div class="container" style="margin: 5px;">
<div class="row">


<ul class="nav nav-pills nav-fill" style="margin-bottom: 5px;" id="myTab">
<li class="nav-item"><a href="#intervention" class="nav-link"  aria-controls="intervention" role="tab" data-toggle="tab">Intervention</a></li>


<li class="nav-item">
<a class="nav-link" href="#liens" aria-controls="liens" role="tab" data-toggle="tab" >Liens</a>
</li>  

<li class="nav-item">
<a class="nav-link" href="#documents" role="tab" data-toggle="tab"  >Documents</a>
</li>  


<li class="nav-item">
<a class="nav-link" href="#rdvs" role="tab" data-toggle="tab"  >RDVs</a>
</li>  




</ul> 
</div>

<div class="row">

<form method="POST" action="{{ route('interventions.update', $intervention->id) }}" enctype="multipart/form-data">
<div class="tab-content" >  
<!-- Le token CSRF -->
@csrf

<!--

usager_id
date_intervention
type_intervention
resultat
observation
id_user
id_interventions_categorie
id_thematique
id_sous_thematique
-->
<div role="tabpanel" class="tab-pane" id="intervention" >




<p style="display:none">
<label for="date_intervention" >Date</label><br/>
<input type="date" name="date_intervention" value="{{ $intervention->date_intervention }}"  id="date_intervention" placeholder="date intervention" >
@error("date_intervention")
<div>{{ $message }}</div>
@enderror
</p>
<p style="display:none">
<label for="user" >employé</label><br/>
<select class="form-select"   name="user" id="user" >
<option value="" >Sélectionner</option>


@foreach ($users as $u)
<option value="{{ $u->id }}"
@if ($intervention->id_user == $u->id) selected="selected" @endif
>{{ $u->name }} ({{ $u->role}})</option>
@endforeach
</select>
@error("id_user")
<div>{{ $message }}</div>
@enderror
</p>

<p>
<label for="interventions_categorie" >Catégorie</label><br/>
<select class="form-select"   name="interventions_categorie" id="interventions_categorie" >
<option value="" >Sélectionner</option>
@foreach ($interventions_categorie as $u)
<option value="{{ $u->id }}"

@if ($intervention->id_interventions_categorie == $u->id) selected="selected" @endif

>{{ $u->nom }}</option>
@endforeach
</select>



@error("id_interventions_categorie")
<div>{{ $message }}</div>
@enderror
</p>



<p>
<label for="usagers" >Usager</label><br/>
<select class="form-select"   name="usager_id" id="usagers" >
<option value="" >Sélectionner</option>
@foreach ($usagers as $u)
<option 
@if ($intervention->usager_id == $u->id) selected="selected" @endif

value="{{ $u->id }}" >{{ $u->nom }} {{ $u->prenom }}</option>
@endforeach

</select>

@error("id_usagers")
<div>{{ $message }}</div>
@enderror
</p>			





<p>
<label for="type_intervention" >Type intervention</label><br/>
<select class="form-select"   name="type_intervention" id="type_intervention" >
<option value="" >Sélectionner</option>
@foreach ($type_interventions as $u)
<option 

@if ($intervention->type_intervention == $u->nom) selected="selected" @endif

value="{{ $u->nom }}" data-id_interventions_categorie="{{ $u->id_interventions_categorie }}"  >{{ $u->nom }}</option>
@endforeach
</select>
@error("type_intervention")
<div>{{ $message }}</div>
@enderror
</p>







<p>
<label for="thematique" >Thematique</label><br/>
<select class="form-select"   name="thematique" id="thematique" >
<option value="" >Sélectionner</option>
@foreach ($thematiques as $u)
<option 

@if ($intervention->id_thematique == $u->id) selected="selected" @endif

value="{{ $u->id }}" data-id_interventions_categorie="{{ $u->id_interventions_categorie }}"  >{{ $u->nom }}</option>
@endforeach
</select>
@error("thematique")
<div>{{ $message }}</div>
@enderror
</p>

<p>
<label for="sous_thematique" >Sous thematique</label><br/>
<select class="form-select"   name="sous_thematique" id="sous_thematique" >
<option value="" >Sélectionner</option>
@foreach ($sous_thematiques as $u)
<option 

@if ($intervention->id_sous_thematique == $u->id) selected="selected" @endif

value="{{ $u->id }}" data-id_parent="{{ $u->id_parent }}" data-liens="{{ $u->liens }}" >{{ $u->nom }}</option>
@endforeach
</select>
@error("sous_thematique")
<div>{{ $message }}</div>
@enderror
</p>


<p>
<label for="observation" >Observation(s)</label><br/>
<textarea name="observation"   id="observation" placeholder="observation" >{{ $intervention->observation }}</textarea>
@error("observation")
<div>{{ $message }}</div>
@enderror


</p>


<p>
<label for="resultat" >Statut de l'intervention</label><br/>


<select class="form-select"   name="resultat" id="resultat" >
<?php 

if ($intervention->resultat != '') {
	$selected = $intervention->resultat;
} else {
	$selected = '';
}



?>
@foreach ($resultats as $u)
<option value="{{ $u->statut }}"
<?php if($selected) echo' selected="selected"'; ?>
>{{ $u->statut }}</option>
@endforeach
</select>



@error("resultat")
<div>{{ $message }}</div>
@enderror
</p>

<p><input type="submit"  class="btn btn-secondary btn-lg envoyer_demande " name="Enregistrer" value="Enregistrer" ></p>

</div>
<div role="tabpanel" class="tab-pane" id="rdvs" >
<p>
<div id="rdvs">
<ol>
	@foreach ($rdvs as $r)

	<?php
//<span class="label label-success"

$event = explode('Poste :', $r->event_name);
$event_name = $event[0];
$poste = $event[1];

	?>

<li><p><b>{{$event_name}}</b> <span class="badge rounded-pill bg-primary p-2 ms-2">Poste {{$poste}}</span></p>
<p>Du {{\Carbon\Carbon::parse($r->event_start)->format('d/m/Y  à h:m')}}</p>
<p>Jusqu 'au {{\Carbon\Carbon::parse($r->event_end)->format('d/m/Y à h:m')}}</p>


</li>

	@endforeach
</ol>

<p>
	<a href="https://psp.facevaucluse.com/create-event?intervention_id={{$intervention->id}}" class="btn btn-secondary btn-sm">Ajouter un rendez-vous à cette intervention</a>
</div>
</p>

</div>

<div role="tabpanel" class="tab-pane" id="liens" >
<p>
<div id="liens">

</div>
</p>

</div>

<div role="tabpanel" class="tab-pane" id="documents" >
<div class="mb-3">

<!--<label class="form-label bold"><b>Documents</label><br>-->
Doc 1 :
<?php if($intervention->doc1) { 
echo '<a href="'.url('public/files/interventions/'.$intervention->doc1).'" target="_blank" >'.$intervention->doc1.'</a><br>';
}else{ echo ' <br>';} ?>
<input type="file" class="form-control" name="doc1" /><hr>

Doc 2 :
<?php if($intervention->doc2) {
echo '<a href="'.url('public/files/interventions/'.$intervention->doc2).'" target="_blank" >'.$intervention->doc2.'</a><br>';
}else{ echo ' <br>';} ?>
<input type="file" class="form-control" name="doc2" /><hr>

Doc 3 :
<?php if($intervention->doc3) {
echo '<a href="'.url('public/files/interventions/'.$intervention->doc3).'" target="_blank" >'.$intervention->doc3.'</a><br>';
}else{ echo ' <br>';} ?>
<input type="file" class="form-control" name="doc3" /><hr>

Doc 4 :
<?php if($intervention->doc4) {
echo '<a href="'.url('public/files/interventions/'.$intervention->doc4).'" target="_blank" >'.$intervention->doc4.'</a><br>';
}else{ echo ' <br>';} ?>
<input type="file" class="form-control" name="doc4" /><hr>
Doc 5 :
<?php if($intervention->doc5) {
echo '<a href="'.url('public/files/interventions/'.$intervention->doc5).'" target="_blank" >'.$intervention->doc5.'</a><br>';
}else{ echo ' <br>';} ?>
<input type="file" class="form-control" name="doc5" /><hr>



</div>

</div>

</div>
</form>
</div>
</div>
<script type="text/javascript">




$(document).ready(function(){
	
	/*$('#thematique option').hide();
	$('#sous_thematique option').hide();
	showOptionSelectionner();*/
	
	function showOptionSelectionner(){
		$('#thematique option:eq(0)').show();
		$('#sous_thematique option:eq(0)').show();
	}

	$('#observation').focus( function() {
  // store original height
  $(this).attr('data-height', $(this).height());
  // animate the height change
  $(this).animate({ height: 300 }, 'slow');
}).blur( function(e) {
  // set to original height
  $(this).animate({ height: $(this).attr('data-height') }, 'slow');
});
	
	
	$('#interventions_categorie').change(function(){
		
		console.log('change interventions_categorie: datas ll change in form !');
		
		let current_inter_cat = $(this).val();
		if( $(this).val() == 0 ){
			
			//$('#div_rodage').show();
			
		}else{
			
			//id_intervention_categorie
			//id_parent
			//$('#thematique').val(0);
			//$('#sous_thematique').val(0);
			$('#thematique option').each(function(){
				if( $(this).data('id_interventions_categorie') == current_inter_cat ){
					$(this).show();
				}else{
					$(this).hide();
				}
			});
			
			$('#type_intervention option').each(function(){
				if( $(this).data('id_interventions_categorie') == current_inter_cat ){
					$(this).show();
				}else{
					$(this).hide();
				}
			});
			
			showOptionSelectionner();
			
			
		}
		
	});
	$('#thematique').change(function(){
		
		console.log('change thematique !');
		
		let current_id_thematique = $(this).val();
		if( $(this).val() == 0 ){
			
			$('#sous_thematique option').hide();
			
		}else{
			
			$('#sous_thematique option').hide();
			$('#sous_thematique option[data-id_parent="'+current_id_thematique+'"]').show();
			
			
			
			
			
		}
		showOptionSelectionner();
	});
	$('#sous_thematique').change(function(){
		
		console.log('change sous thematique !');
		
		let current_id_sous_thematique = $(this).val();
		if( $(this).val() == 0 ){
			
			//$('#sous_thematique option').hide();
			
		}else{
			
			
			loadLinks();
			
			
			
		}
		showOptionSelectionner();
	});


	
	$('.envoyer_demande').click(function(e){
		/*
		e.preventDefault();
		var id_demande = $(this).attr('data-demande_id');
		var statut = $(this).attr('rel');
		var data = {"_token": "{{ csrf_token() }}",id_demande:id_demande,statut:statut};
		$.ajax({
			//url: "https://psp.facevaucluse.com/public/demande_modification_statut",
			type: 'POST',
			
			data: data,
			success: function(response){
				// $('.delete_recette[rel='+id+']').parent().find('tr').remove();
				$('.statut[data-demande_id='+id_demande+']').addClass('disabled');
				$('.statut[data-demande_id='+id_demande+'][rel='+statut+']').removeClass('disabled').addClass('active');
				
				$('#validation').append('<div class="alert alert-primary alert-success" role="alert">Votre dossier a bien été validé  ! </div>');
				$('.envoyer_demande').hide();
			}
		});*/
	});

	function loadLinks(){
		let current_liens =  $('#sous_thematique option:selected').data('liens');

		if( current_liens ){
			$('#liens').html(
				
				'<ul>' + current_liens.split(',').map(function(lien){
					return '<li><a href="'+lien+'" target="_blank" >'+lien+'</a></li>';
				}).join('') + '</ul>'
			);

		}

	}


	loadLinks();
});
</script>

@endsection
