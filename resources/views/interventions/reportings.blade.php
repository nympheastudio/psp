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
<ul>
	<li><a href="#"> PSP Par médiateur</a></li>
	<li><a href="#"> PSP Par tranche de date</a></li>

	<script type="text/javascript">
$(document).ready(function(){


});
</script>
@endsection
