<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name=”keywords” content="tatame online, tatameonline, artes marciais, tatame on, tatame, luta, fight, gerenciamento, controle, jiu-jitsu, tatame online, online, sistema de luta, sistema, JIU JITSU, JIU-JITSU, Muay thai, Muay-thai, judô, JUDÔ, graduação, graduacao" />
    <meta property="og:url" content="http://www.tatameonline.com.br/" />
    <meta property="type" content="website" />
    <meta property="og:title" content="TATAME ONLINE">
    <meta property="og:description" content="Sistema de gestão de academias de artes marciais">
    <meta property="og:image" content="{{asset("img/site/3min.jpg")}}">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="480">

    <link rel="icon" href="{{asset("img/ico-page.png")}}">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#3c8dbc">

  <title>TaTame Online - Sistema de gestão de academias de artes marciais.</title>


  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap4.min.css" rel="stylesheet">


  <!-- Custom fonts for this template -->
  <link href="vendor/adminlte/vendor/font-awesome/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.min.css" rel="stylesheet">


  <!-- Site css -->
  <link href="css/siteMobile.css" rel="stylesheet">


</head>

<body>


  <!-- Login Section -->
  <section id="login" class="signup-section">
    <div class="container">
      <div class="row">
        <div class="mx-auto text-center">

            <h2 class="mx-auto mt-0 mb-3"><img width="80" src="{{asset("img/icoMobile.png")}}"></h2>
            <h2 class="text-white-50 mx-auto mt-0 mb-4" style="color:#3c8dbc!important">LOGIN</h2>

            <form method="POST" action="{{ route('login.post') }}" class="form-inline d-flex">
                @csrf
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                    <input required type="email" class="form-control flex-fill mr-0 mb-3" name="email" placeholder="Informe seu email" style="text-transform: none;">

                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                    <input required type="password" class="form-control flex-fill mr-0 mb-3" name="password" placeholder="Informe a senha" style="text-transform: none;">

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

                    <select required class="form-control flex-fill mr-0 mb-3" name="idAcademy" style="text-transform: none;">
                        <option value="">-- Selecione --</option>
                        @foreach($academies as $academy)
                        <option value="{{$academy->id}}">{{$academy->name}}</option>
                        @endforeach
                    </select>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-ban"></i> {{session('error')}}
                        </div>
                    @endif

                </div>
                <button type="submit" class="btn btn-primary mx-auto" style="background-color: #3c8dbc">Entrar</button>
            </form>

        </div>
      </div>
    </div>
  </section>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/adminlte/vendor/jquery/dist/jquery.min.js"></script>
  <script src="js/common/bootstrap4.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/common/grayscale.min.js"></script>

  <!-- Animation login -->
  <script src="js/common/app-animation.js"></script>

  <script src="{{ asset('js/common/owl.carousel.min.js') }}"></script>

  <script src="{{ asset('js/common/flipclock.min.js') }}"></script>

  <script type="text/javascript">

    $(document).ready(function(){

        $(".owl-carousel").owlCarousel({
            loop:true,
            margin:50,
            nav:true,
            dots:true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            items: 3
        });

        var clock;

        // Instantiate a counter
        clock = new FlipClock($('.clock'), 120, {
            clockFace: 'MinuteCounter',
            autoStart: true,
            countdown: true,
            language: 'pt-br'
        });

    })

  </script>

</body>

</html>
