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
		</ul> 
	</div>

	<div class="row">
		<form method="POST" action="{{ route('interventions.store') }}" enctype="multipart/form-data">
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



					<div class="form-group radio-cat">
						<label  >Catégorie</label><br/>
						<!--<select class="form-control form-control-lg"  name="interventions_categorie" id="interventions_categorie" >
						@foreach ($interventions_categorie as $u)
						<option value="{{ $u->id }}" >{{ $u->nom }}</option>
						@endforeach
						</select>-->
						<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					
					

						@foreach ($interventions_categorie as $u)

						<?php

						$nom = $u->nom;
						$nom = str_replace(' ', '', $nom);

?>

<div class="d-inline-block btn btn-sm ">
   
<input  value="{{ $u->id }}" type="radio" name="interventions_categorie" id="i_{{$u->id}}"
	
	><label  for="i_{{$u->id}}">{{ $u->nom }}</label> 
    
</div>
@endforeach
</div>
    		</div>



						@error("id_interventions_categorie")
						<div>{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="date_intervention" >Date</label><br/>
						<input type="date" name="date_intervention" value="{{ old('date_intervention') }}"  id="date_intervention" placeholder="date intervention" class="form-control">
						@error("date_intervention")
						<div>{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="user" >Utilisateur</label><br/>
						<select class="form-select"   name="user" id="user" >
						<option value="" >Sélectionner</option>
						@foreach ($users as $u)
						<option value="{{ $u->id }}" >{{ $u->name }} ({{ $u->role}})</option>
						@endforeach
						</select>
						@error("id_user")
						<div>{{ $message }}</div>
						@enderror
					</div>

					

					<div class="form-group">
						<label for="usagers" >Usager</label>
						<a href="https://psp.facevaucluse.com/usagers/create" target="blank" class="btn btn-link">Créer un usager</a>
						<br/>
						{{--
						<select class="form-select"   name="usager_id" id="usagers" >
						<option value="" >Sélectionner</option>
						@foreach ($usagers as $u)
						<option value="{{ $u->id }}" >{{ $u->nom }} {{ $u->prenom }}</option>
						@endforeach
						</select>--}}

						<input id="usagers" name="usagers" type="text" list="usagers_id_datalist" class="form-control" placeholder="Nom de l'usager">
						<datalist id="usagers_id_datalist">
						@foreach ($usagers as $u)
							<option rel="{{ $u->id }}" value="{{ $u->nom }} {{ $u->prenom }}">
						@endforeach
						</datalist>
						<input id="usager_id" name="usager_id" type="hidden" value="" >

						@error("id_usagers")
						<div>{{ $message }}</div>
						@enderror
					</div>			

					<div class="form-group">
						<label for="type_intervention" >Type intervention</label><br/>
						<select class="form-select"   name="type_intervention" id="type_intervention" >
						<option value="" >Sélectionner</option>
						@foreach ($type_interventions as $u)
						<option value="{{ $u->nom }}" data-id_interventions_categorie="{{ $u->id_interventions_categorie }}"  >{{ $u->nom }}</option>
						@endforeach
						</select>
						@error("type_intervention")
						<div>{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="thematique" >Thematique</label><br/>
						<select class="form-select"   name="thematique" id="thematique" >
						<option value="" >Sélectionner</option>
						@foreach ($thematiques as $u)
						<option value="{{ $u->id }}" data-id_interventions_categorie="{{ $u->id_interventions_categorie }}"  >{{ $u->nom }}</option>
						@endforeach
						</select>
						@error("thematique")
						<div>{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="sous_thematique" >Sous thematique</label><br/>
						<select class="form-select"   name="sous_thematique" id="sous_thematique" >
						<option value="" >Sélectionner</option>
						@foreach ($sous_thematiques as $u)
						<option value="{{ $u->id }}" data-id_parent="{{ $u->id_parent }}" data-liens="{{ $u->liens }}" >{{ $u->nom }} </option>
						@endforeach
						</select>
						@error("sous_thematique")
						<div>{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="observation" >Observation(s)</label><br/>
						<textarea name="observation" class="form-control"  id="observation" placeholder="observation" >{{ old('observation') }}</textarea>
						@error("observation")
						<div>{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="resultat" >Statut de l'intervention</label><br/>

						<select class="form-select"   name="resultat" id="resultat" >

						@foreach ($resultats as $u)
						<option 
						value="{{ $u->statut }}" >{{ $u->statut }}</option>
						@endforeach
						</select>



						@error("resultat")
						<div>{{ $message }}</div>
						@enderror
					</div>
					
					<div class="form-group"><input type="submit"  class="btn btn-primary btn-lg envoyer_demande " name="Enregistrer" value="Enregistrer" ></div>
				</div>

				<div role="tabpanel" class="tab-pane" id="liens" >
					<p>
						<div id="liens">
						</div>
					</p>
				</div>

				<div role="tabpanel" class="tab-pane" id="documents" >
					<div class="mb-3">
						<label class="form-label bold"><b>Document</label>
						<input type="file" class="form-control" name="doc1" /><br>
						<input type="file" class="form-control" name="doc2" /><br>
						<input type="file" class="form-control" name="doc3" /><br>
					</div>

				</div>

			</div>
		</form>
	</div>
</div>



<script type="text/javascript">
$(document).ready(function(){

	

	$('input[name="interventions_categorie"]').change(function(){ 
		
		$.each( $('input[name="interventions_categorie"]'), function( key, value ) {
		$(this).attr('checked', false);
	});
		changed();
	});

function changed() {
  id = $('input[name="interventions_categorie"]:checked').val();
	// alert(id);
	setTimeout(function(){
	$("#i_"+id).attr('checked','checked');
	},10);
}
	//add/remove attr checked to radios named "interventions_categorie"
/*
	$('input[name="interventions_categorie"]').on('change', function() {

		console.log($(this).attr('id'));
		$(this).parent('.btn').removeClass('active');
		if( $(this).attr('id') === 'i_1' ){
			$('#i_1').prop('checked', true);
			$(this).parent('.btn').addClass('active');
			$('#i_2').removeAttr('checked');
			$('#i_3').removeAttr('checked');
		}else if( $(this).attr('id') === 'i_2' ){
			$('#i_2').prop('checked', true);
			$(this).parent('.btn').addClass('active');
			$('#i_1').removeAttr('checked');
			$('#i_3').removeAttr('checked');
		}else if( $(this).attr('id') === 'i_3' ){
			$('#i_3').prop('checked', true);
			$(this).parent('.btn').addClass('active');
			$('#i_1').removeAttr('checked');
			$('#i_2').removeAttr('checked');
		}
*/


	

		//if is checked
		/*
		if( $(this).is(':checked') ) {
			//$('input[name="interventions_categorie"]').not(this).removeAttr('checked');
			console.log($(this).attr('id'));
			$(this).prop('checked',true).click(); 
		}else{
			$(this).prop('checked',false); 
		}*/
		
		//$('#'.$(this).attr('id')).attr('checked');

	//});


	/*$('#interventions_categorie').each(function(i, select){
    var $select = $(select);
    $select.find('option').each(function(j, option){
        var $option = $(option);
        // Create a radio:
        var $radio = $('<input type="radio" data-toggle="toggle" data-onstyle="dark" data-offstyle="light" data-style="border" />');
        // Set name and value:
        $radio.attr('name', $select.attr('name')).attr('value', $option.val());
        // Set checked if the option was selected
        if ($option.attr('selected')) $radio.attr('checked', 'checked');
        // Insert radio before select box:
        $select.before($radio);
        // Insert a label:
        $select.before(
          $("<label class='btn-outline-info' />").attr('for', $select.attr('name')).text($option.text())
        );
    });
    $select.remove();
});*/

$("#usagers").on('input', function () {
    var val = this.value;
    if($('#usagers_id_datalist option').filter(function(){
        return this.value.toUpperCase() === val.toUpperCase();        
    }).length) {
        //send ajax request
        //alert(this.value);
        let rel = $('#usagers_id_datalist option[value="'+this.value+'"]').attr('rel');
       // alert(rel);
        $('#usager_id').val(rel);
    }
});
	
	$('#thematique option').hide();
	$('#sous_thematique option').hide();
	showOptionSelectionner();
	
	function showOptionSelectionner(){
		$('#thematique option:eq(0)').show();
		$('#sous_thematique option:eq(0)').show();
	}
	
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
			
			let current_liens =  $('#sous_thematique option:selected').data('liens');
			$('#liens').html(
				
				current_liens 
			);
			
			
			
			
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
			//url: "https://www.fonds.festivaloffavignon.com/public/demande_modification_statut",
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
});
</script>

@endsection
