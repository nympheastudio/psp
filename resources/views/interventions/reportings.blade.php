@extends('template')
@section('contenu')
<h2>Total béneficiaire : </h2>
<p>Total Usagers : {{ $total_usagers }}</p>
<p>Total Interventions : {{ $total_interventions }}</p>
<p>Total Interventions en cours : {{ $total_interventions_en_cours }}</p>
<p>Total Interventions cloturées : {{ $total_interventions_cloturees }}</p>

<p>Total Interventions 2022 : {{ $total_interventions_2022 }}</p>
<p>Total Interventions en cours : {{ $total_interventions_current }}</p>

<h2>Exports : </h2>
<!--
<ul>
	<li><a href="#"> PSP Par médiateur</a></li>
	<li><a href="#"> PSP Par tranche de date</a></li>
</ul>-->

<form method="POST" action="https://psp.facevaucluse.com/reportings-export">


<div class="form-group">
@csrf
<select name="users" class="form-select">
<option value="">Utilisateurs</option>
@foreach ($users as $user)
<option value="{{ $user->id }}">{{ $user->name }}</option>
@endforeach
</select>
</div>
<div class="form-group">

<input type="date" name="date_start" value="" placeholder="Date de début" class="form-control">
</div>
<div class="form-group">
<input type="date" name="date_end" value="" placeholder="Date de fin" class="form-control"> 
</div>
<div class="form-group">
<input type="submit" value="Exporter les interventions" class="btn btn-primary">
</div>

</form>

<script type="text/javascript">
$(document).ready(function(){


});
</script>
@endsection
