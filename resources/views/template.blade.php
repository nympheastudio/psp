<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PSP</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

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

  <!-- Favicons -->
  <link href="https://psp.facevaucluse.com/public/assets/img/favicon.png" rel="icon">
  <link href="https://psp.facevaucluse.com/public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://psp.facevaucluse.com/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://psp.facevaucluse.com/public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://psp.facevaucluse.com/public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://psp.facevaucluse.com/public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="https://psp.facevaucluse.com/public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="https://psp.facevaucluse.com/public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="https://psp.facevaucluse.com/public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template Main CSS File -->
  <link href="https://psp.facevaucluse.com/public/assets/css/style.css" rel="stylesheet">


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
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../../../../" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">PSP</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    @auth

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        

       

        

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                       <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->




          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->name}}</h6>
              <span>{{Auth::user()->role}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           

            <li>
              <a class="dropdown-item d-flex align-items-center" id="show_modal_param" href="#">
                <i class="bi bi-gear"></i>
                <span>Parametres</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('signout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Déconnexion</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
@endauth
  </header><!-- End Header -->

  @auth
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
      <a class="nav-link" href="https://psp.facevaucluse.com/">
          <i class="bi bi-grid"></i>
          <span>Accueil</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Agenda</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/dashboard">
              <i class="bi bi-circle"></i><span>Mon Agenda</span>
            </a>
          </li>
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/create-event">
              <i class="bi bi-circle"></i><span>Créer un RDV</span>
            </a>
          </li>
          @if (Auth::user()->role == 'admin' )
  
  <li>
  <a class="nav-link" href="https://psp.facevaucluse.com/agenda-global">
              <i class="bi bi-circle"></i><span>Agenda Global</span>
            </a>
          </li>
  @endif
          
         
        </ul>
      </li><!-- End Agenda Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Interventions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/interventions">
              <i class="bi bi-circle"></i><span>Liste d'interventions</span>
            </a>
          </li>
          <li>
          <a class="nav-link" href="{{ route('interventions.create') }}"  >
              <i class="bi bi-circle"></i><span>Créer une intervention</span>
            </a>
          </li>
        
        </ul>
      </li><!-- End Interventions Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person"></i><span>Usagers</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/usagers">
              <i class="bi bi-circle"></i><span>Liste des usagers</span>
            </a>
          </li>
          <li>
          <a class="nav-link" href="{{ route('usagers.create') }}"  >
              <i class="bi bi-circle"></i><span>Créer un usager</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      
  @if (Auth::user()->role == 'admin' )
  
  

  

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Reportings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/reportings">
              <i class="bi bi-circle"></i><span>Export PSP</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/users">
              <i class="bi bi-circle"></i><span>Utilisateurs</span>
            </a>
          </li>
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/registration"  >
              <i class="bi bi-card-list"></i><span>Créer un utilisateur</span>
            </a>
          </li>
          <li>
          <a class="nav-link" href="https://psp.facevaucluse.com/listes">
              <i class="bibi-question-circle"></i><span>Liste statiques</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      @endif

      <li class="nav-item">
        <a class="nav-link collapsed" href="https://psp.facevaucluse.com/filemanager">
          <i class="bi bi-file-earmark"></i>
          <span>Documents</span>
        </a>
      </li><!-- End Profile Page Nav -->

     

    </ul>

  </aside><!-- End Sidebar-->
  @endauth
  <main id="main" class="main">

    <div class="pagetitle">
      <h1> </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://psp.facevaucluse.com">Accueil</a></li>
          <li class="breadcrumb-item active">&nbsp;</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
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
  if(isset($user)){
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
  
  
  
  
  
  
 
  
  
  

      </div>
    </section>

  </main><!-- End #main -->

 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor Jhttps://psp.facevaucluse.com/public/S Files -->
  <script src="https://psp.facevaucluse.com/public/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/chart.js/chart.min.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/echarts/echarts.min.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/quill/quill.min.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="https://psp.facevaucluse.com/public/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="https://psp.facevaucluse.com/public/assets/js/main.js"></script>
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


    function getTitleAndBreadCrumb(){
      //change h1 and breadcrimb
      const {
        host, hostname, href, origin, pathname, port, protocol, search
      } = window.location;

      let text2show = '';
      /*
      .pagetitle h1
      .pagetitle .breadcrumb-item .active
          */
         switch(pathname){
case "/dashboard": text2show = 'Agenda';break;

case "/documents": text2show = 'documents';break;

case "/reportings": text2show = 'reportings';break;

case "/login": text2show = 'login';break;
case "/registration": text2show = 'register-user';break;
case "/signout": text2show = 'signout';break;
case "/users": text2show = 'users';break;
case "/listes": text2show = 'listes';break;

case "/agenda": text2show = 'Agenda';break;


case "/create-event": text2show = 'Créer un RDV';break;

case "/agenda-global": text2show = 'Agenda Global';break;


case "/usagers": text2show = 'usagers';break;
case "/usagers/create": text2show = 'Créer un usager';break;

case "/usagers/{usager}/edit": text2show = 'usagers.edit';break;
case "/interventions": text2show = 'interventions';break;
case "/interventions/create": text2show = 'Créer une intervention';break;

case "/filemanager": text2show = 'Documents';break;

default: text2show = pathname;

         }         
         $('.pagetitle h1').text(text2show);
         $('.breadcrumb .active').text(text2show);

    }

    //wait 1 second in javascript
    function delay(time) {
  return new Promise(resolve => setTimeout(resolve, time));
}

delay(10).then(() => getTitleAndBreadCrumb());


   
    $(document).ready(function(){
      
      
      
      $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
      });
      
      $("#show_modal_aide").click(function(){
        
        $('#modalAide').modal('show');
        
      });
      
      $("#show_modal_param").click(function(){
        
        $('#modalParam').modal('show');
        
      });
      
    
      
      
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

      // foreach .mime-icon  add icon by filetype // each jquery

/*

$( ".mime-icon" ).each(function( index ) {
  //$( this ).text() );
 // let filetype = $( this ).attr('class').split(' ')[1];
 $( this  + '.mime-icon .iso-docx').html('<img src="https://psp.facevaucluse.com/public/img/ico-docx.png" alt="docx" />');
 $( this + ' .iso-xlsx').html('<img src="https://psp.facevaucluse.com/public/img/ico-xlsx.png" alt="xlsx" />');
 $( this + ' .iso-pdf').html('<img src="https://psp.facevaucluse.com/public/img/ico-pdf.png" alt="pdf" />');


});
      
   */
      

      

      //.ico-pdf
  
      
    });

    
    </script>
   

    </body></html>