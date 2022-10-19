<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PSP</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.0/dist/css/bootstrap.min.css">
{{--<link rel="stylesheet" href="https://psp.facevaucluse.com/public/css/bootstrap.min.css" />--}}
<link rel="stylesheet" href="https://psp.facevaucluse.com/public/js/Accordion.JS-master/accordion.css" />
<link rel="stylesheet" href=" //cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="https://psp.facevaucluse.com/public/css/nymphea.css" />
<style>
.psp-Switch > input[type="checkbox"] {
  display: none;   
}

.psp-Switch > label {
  cursor: pointer;
  height: 0px;
  position: relative; 
  width: 40px;  
}

.psp-Switch > label::before {
  background: rgb(0, 0, 0);
  box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
  border-radius: 8px;
  content: '';
  height: 16px;
  margin-top: -8px;
  position:absolute;
  opacity: 0.3;
  transition: all 0.4s ease-in-out;
  width: 40px;
}
.psp-Switch > label::after {
  background: rgb(255, 255, 255);
  border-radius: 16px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
  content: '';
  height: 24px;
  left: -4px;
  margin-top: -8px;
  position: absolute;
  top: -4px;
  transition: all 0.3s ease-in-out;
  width: 24px;
}
.psp-Switch > input[type="checkbox"]:checked + label::before {
  background: inherit;
  opacity: 0.5;
}
.psp-Switch > input[type="checkbox"]:checked + label::after {
  background: inherit;
  left: 20px;
}

.navbar {
  border-radius: 0;
  margin-bottom: 0px;
}
#menu
{
  /*background-color:#FFD700;*/
  height: 100%;
  width:200px;
  float:left;
}

#contenu_template
{
  /*background-color:#EEEEEE;*/
  height: 100%;
  padding-left:10px;
  overflow:auto;
}

.loader-container {
  width: 100%;
  height: 100vh;
  position: fixed;
  background: #000
  url("https://media.giphy.com/media/8agqybiK5LW8qrG3vJ/giphy.gif") center
  no-repeat;
  z-index: 1;
}


</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



<link href="https://psp.facevaucluse.com/public/css/jquery-fab-button.css" rel="stylesheet">

<script src="https://psp.facevaucluse.com/public/js/jquery-fab-button.min.js"></script>

@yield('entete')
</head>
<body>

<nav class="navbar navbar-expand-lg  bg-primary">
<div class='navbar-brand'>
<img src="https://facevaucluse.com/images/logo.jpg" class="img-fluid" alt="PSP" style="width: auto; height: 50px;">
</div><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  @auth
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{Auth::user()->name}} ({{Auth::user()->role}})
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('signout') }}">Déconnexion </a>

          <a class="dropdown-item" id="show_modal_param" href="#">parametres</a>
         
         <!-- <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">test sous rubrique</a>
-->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " id="show_modal_aide" href="#">Aide</a>
      </li>
    </ul>
   {{--  <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>--}}
  </div>
  @endauth
</nav>

<!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>-->
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
@guest
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">Se connecter</a>
</li>


@else




<li class="nav-item">
<a class="nav-link" href="{{ route('signout') }}">Déconnexion {{Auth::user()->name}} ({{Auth::user()->role}})</a>
</li>




@endguest
</ul>
</div>

</nav>

@auth
<div id="menu" >

<ul id="my-accordion" class="accordionjs">


<li>
<div>Agenda</div>
<div>
<a class="nav-link" href="https://psp.facevaucluse.com/dashboard">Mon Agenda</a><br>
<a class="nav-link" href="https://psp.facevaucluse.com/create-event">Créer RDV</a><br>
@if (Auth::user()->role == 'admin' )
<a class="nav-link" href="https://psp.facevaucluse.com/agenda-global">Agenda Global</a><br>
@endif
</div>
</li>

<!-- Section 1 -->
<li>
<div>Interventions</div>
<div>
<a class="nav-link" href="https://psp.facevaucluse.com/interventions">Lister</a><br>
<a class="nav-link" href="{{ route('interventions.create') }}"  >Créer une intervention</a>
</div>
</li>

<!-- Section 2 -->
<li>
<div>Usagers</div>
<div>

<a class="nav-link" href="https://psp.facevaucluse.com/usagers">Lister</a><br>
<a class="nav-link" href="{{ route('usagers.create') }}"  >Créer un usager</a>

</div>
</li>


@if (Auth::user()->role == 'admin' )



<li>
<div>Reportings</div>
<div>

<a class="nav-link" href="https://psp.facevaucluse.com/reportings">Reportings</a>

</div>
</li>

<li>
<div>Admin</div>
<div>

<a class="nav-link" href="https://psp.facevaucluse.com/users">Utilisateurs</a><br>
<a class="nav-link" href="https://psp.facevaucluse.com/registration"  >Créer un utilisateur</a><br>
<a class="nav-link" href="https://psp.facevaucluse.com/listes">Listes statiques</a><br>

</div>
</li>

@endif
<li>
<div>Documents</div>
<div>

<a class="nav-link" href="https://psp.facevaucluse.com/filemanager">Documents</a><br>


</div>
</li>

</ul>



</div>
@endauth
<div id="contenu_template" >




@yield('contenu')

</div>

<!-- modal aide -->
<div class="modal fade" id="modalAide" tabindex="-1" aria-labelledby="modalAideLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modalAideLabel">Aide</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">X</button>
</div>
<div class="modal-body">
<p>lorem ipsum</p>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>-->
</div>
</div>
</div>
</div>

<!-- modal param -->
<div class="modal fade" id="modalParam" tabindex="-1" aria-labelledby="modalParamLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modalParamLabel">Paramètres</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">X</button>
</div>
<div class="modal-body" id="contenu-param">
<ul>
  <?php
$params =  Auth::user()->params ;

//var_dump($params);
//string(39) "event_bgcolor:green,last_login:01012022"

$tab = explode(",",$params);
//var_dump($tab);

foreach ($tab as $key => $value) {
  $tab2 = explode(":",$value);
  //var_dump($tab2);
  $tab3[$tab2[0]] = $tab2[1];

 
  $label = str_replace('last_login','Dernière connexion', $tab2[0]);

 if($tab2[0] == 'event_bgcolor') {
  $value = '<div style="height:10px;width:10px;background-color:'.  $tab2[1] . '">&nbsp;</div>' ;
  $label = str_replace('event_bgcolor','Couleur case agenda', $tab2[0]);
 }else{
  $value = $tab2[1];
 }



 

  echo '<li><b>' . $label . '</b> :' . $value . '</li>';
}

//var_dump($tab3);

  ?>

</ul>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>-->
</div>
</div>
</div>
</div>






@yield('footer')
<script>
var info={

timeOpened:new Date(),
timezone:(new Date()).getTimezoneOffset()/60,

pageon(){return window.location.pathname},
referrer(){return document.referrer},
previousSites(){return history.length},

browserName(){return navigator.appName},
browserEngine(){return navigator.product},
browserVersion1a(){return navigator.appVersion},
browserVersion1b(){return navigator.userAgent},
browserLanguage(){return navigator.language},
browserOnline(){return navigator.onLine},
browserPlatform(){return navigator.platform},
javaEnabled(){return navigator.javaEnabled()},
dataCookiesEnabled(){return navigator.cookieEnabled},
dataCookies1(){return document.cookie},
dataCookies2(){return decodeURIComponent(document.cookie.split(";"))},
dataStorage(){return localStorage},

sizeScreenW(){return screen.width},
sizeScreenH(){return screen.height},
sizeDocW(){return document.width},
sizeDocH(){return document.height},
sizeInW(){return innerWidth},
sizeInH(){return innerHeight},
sizeAvailW(){return screen.availWidth},
sizeAvailH(){return screen.availHeight},
scrColorDepth(){return screen.colorDepth},
scrPixelDepth(){return screen.pixelDepth},


latitude(){return position.coords.latitude},
longitude(){return position.coords.longitude},
accuracy(){return position.coords.accuracy},
altitude(){return position.coords.altitude},
altitudeAccuracy(){return position.coords.altitudeAccuracy},
heading(){return position.coords.heading},
speed(){return position.coords.speed},
timestamp(){return position.timestamp},


};
var goto2Https = window.location.href+'';
if (goto2Https.indexOf('http://')==0){window.location.href = goto2Https.replace('http://','https://');}
  var csrfToken = $('[name="csrf_token"]').attr('content');
  
  setInterval(refreshToken, 3600000); // 1 hour 
  
  function refreshToken(){
    $.get('refresh-csrf').done(function(data){
      csrfToken = data; // the new token
    });
  }
  
  setInterval(refreshToken, 3600000); // 1 hour 
  
  $(document).ready(function(){
    

    $('#info')
    
$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});

$("#show_modal_aide").click(function(){

$('#modalAide').modal('show');

});

$("#show_modal_param").click(function(){

$('#modalParam').modal('show');

});
    
    /* 
    $('input[type=text]').mouseover(function(){
      
      this.holder=$(this).attr('placeholder');
      $(this).attr('alt', this.holder);
      
    });*/
    
    
      //TABS
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  
  if(activeTab){
    
    $( '#description' ).removeClass('active');
    $('#myTab a[href="' + activeTab + '"]').tab('show');
    
    // alert(activeTab);
    if(activeTab != '#validation'){
      $('#enregistrer_demande').show();
    }
    
    
  }else{
    
    $( '#description' ).addClass('active');
    $('#enregistrer_demande').show();
    
  }
    
    
    
    //TOOLTIP
    $('[data-toggle="tooltip"]').tooltip();
    
    $('input:not(:disabled)').tooltip({
      'template': '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>',
      'placement':'right',
      'title': function(){
        return $(this).attr('placeholder');
      },
    });
    
    $('select').tooltip({
      'template': '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>',
      'placement':'right',
      'title': function(){
        let label = $(this).closest("p").find("label").text();
        return label;
      },
    });
    
  });
  
  </script>
  <script>
  /* const loaderContainer = document.querySelector('.loader-container');
  
  window.addEventListener('load', () => {
    loaderContainer.classList.add('fade-out');
  });*/
  
  $(document).ready(function(){
    $('#my-accordion').hide();
    //agenda, interventions, usagers, documents, reportings, Equipe
    let activeIndex = 1;
    
    if (window.location.href.includes('dashboard')) {
      activeIndex = 1;
    }
    if (window.location.href.includes('interventions')) {
      activeIndex = 2;
    }
    if (window.location.href.includes('usagers')) {
      activeIndex = 3;
    }
    if (window.location.href.includes('filemanager')) {
      activeIndex = 6;
    }
    if (window.location.href.includes('reportings')) {
      activeIndex = 4;
    }
    if (window.location.href.includes('agenda-global')) {
      activeIndex = 5;
    }
    if (window.location.href.includes('users')) {
      activeIndex = 5;
    }
    if (window.location.href.includes('registration')) {
      activeIndex = 5;
    }
    
    
    
    $("#my-accordion").accordionjs({
      // Allow self close.(data-close-able)
      closeAble   : false,
      
      // Close other sections.(data-close-other)
      closeOther  : true,
      
      // Animation Speed.(data-slide-speed)
      slideSpeed  : 150,
      
      // The section open on first init. A number from 1 to X or false.(data-active-index)
      activeIndex : activeIndex,
      
      // Callback when a section is open
      openSection: function( section ){},
      
      // Callback before a section is open
      beforeOpenSection: function( section ){},
    });
    
    $('#my-accordion').show();
  });
  </script>
  <script src="https://psp.facevaucluse.com/public/js/Accordion.JS-master/accordion.min.js"></script>
  </body></html>