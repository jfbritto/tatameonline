<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name=”keywords” content="artes marciais, tatame on,tatame online, tatameonline, tatame, luta, fight, gerenciamento, controle, jiu-jitsu, tatame online, online, sistema de luta, sistema, JIU JITSU, JIU-JITSU, Muay thai, Muay-thai, judô, JUDÔ, graduação, graduacao" />
    <meta property="og:url" content="http://www.tatameonline.com.br/" />
    <meta property="type" content="website" />
    <meta property="og:title" content="TATAME ONLINE">
    <meta property="og:description" content="Sistema de gestão de academias de artes marciais">
    <meta property="og:image" content="{{asset("img/site/1min.jpg")}}">
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

  {{-- <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"> --}}

  {{-- <link rel="stylesheet" href="{{ asset('css/flipclock.css') }}"> --}}

  <!-- Site css -->
  <link href="css/site.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">TaTame Online</a>
      <button style="color: #3c8dbc; border-color: #3c8dbc" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          {{-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#projects">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#clients">Igrejas</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#plans">Planos</a>
          </li>
          <li class="nav-item">
                @auth
                    @if(auth()->user()->isRoot)
                        <a class="nav-link js-scroll-trigger" href="{{ url('/root') }}">Home</a>
                    @elseif(auth()->user()->isAdmin)
                        <a class="nav-link js-scroll-trigger" href="{{ url('/admin') }}">Home</a>
                    @elseif(auth()->user()->isStudent)
                        <a class="nav-link js-scroll-trigger" href="{{ url('/student') }}">Home</a>
                    @endif
                @else
                    <a class="nav-link js-scroll-trigger" href="#login">Login</a>
                @endauth
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contato</a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">TaTame Online</h1>
        <h2 class="text-white-50 mx-auto mt-2 mb-5">Um novo conceito de organização.</h2>
        <a href="#login" class="btn btn-primary js-scroll-trigger" style="background-color: #3c8dbc">Efetuar login</a>
      </div>
    </div>
  </header>

  <!-- About Section -->
  {{-- <section id="about" class="about-section text-center d-flex">
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-8 mx-auto mx-auto">
          <h2 class="text-white mb-4">FAÇA TUDO EM UM ÚNICO LUGAR</h2>
          <p class="text-white-50 text-justify">O IGREJA CONTROLE foi criado a partir da necessidade de ter as informações mais organizadas,
                                    de ter o controle necessário sem ser preciso que os dados ficassem salvos em apenas um computador, limitando a mobilidade e o acesso às informações.
                                    Assim surgiu nosso sistema, onde tudo fica mais fácil e transparente.</p>
        </div>
      </div>
      <!-- <img src="img/ipad.png" class="img-fluid" alt=""> -->
    </div>
  </section> --}}

  <!-- Projects Section -->
  {{-- <section id="projects" class="projects-section bg-light">
    <div class="container">

      <!-- Featured Project Row -->
<!--       <div class="row align-items-center no-gutters mb-4 mb-lg-5">
        <div class="col-xl-8 col-lg-7">
          <img class="img-fluid mb-3 mb-lg-0" src="img/aegee.jpg" alt="">
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="featured-text text-center text-lg-left">
            <h4>Controle de membros</h4>
            <p class="text-black-50 mb-0">Cadastre ou simplesmente envie o link para os próprios membros preencherem seus dados, tornando todo o controle muito mais fácil!</p>
          </div>
        </div>
      </div> -->

      <h2 class="text-black-50 mx-auto mt-2 mb-5 text-center">Serviços</h2>

      <!-- Project One Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/aegee.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-left">
                <h4 class="text-white">Controle de membros</h4>
                <p class="mb-0 text-white-50 text-justify">Cadastre ou simplesmente envie o link para os próprios membros preencherem seus dados, tornando todo o controle muito mais fácil!</p>
                <hr class="d-none d-lg-block mb-0 ml-0">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Project Two Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/event.jpg" alt="">
        </div>
        <div class="col-lg-6 order-lg-first">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-right">
                <h4 class="text-white">Agenda</h4>
                <p class="mb-0 text-white-50 text-justify">Saiba quando, onde e em qual horário serão os próximos compromissos!</p>
                <hr class="d-none d-lg-block mb-0 mr-0">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Project One Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/retiro.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-left">
                <h4 class="text-white">Eventos</h4>
                <p class="mb-0 text-white-50 text-justify">Abandone o papel e caneta! com apenas um link todos os participantes poderão realizar suas inscrições nos retiros e caravanas!</p>
                <hr class="d-none d-lg-block mb-0 ml-0">
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Project Four Rows -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/financa.jpg" alt="">
        </div>
        <div class="col-lg-6 order-lg-first">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-right">
                <h4 class="text-white">Controle de caixa</h4>
                <p class="mb-0 text-white-50 text-justify">Organize as finanças de sua igreja mais facilmente. Deixe que a gente te mostre o quanto pode ser simples!</p>
                <hr class="d-none d-lg-block mb-0 mr-0">
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Project One Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/cells.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-left">
                <h4 class="text-white">Células</h4>
                <p class="mb-0 text-white-50 text-justify">Mantenha a organização das células, envie os estudos da semana e disponibilize as informações necessárias para o seu bom funcionamento!</p>
                <hr class="d-none d-lg-block mb-0 ml-0">
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Project Four Rows -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/folders.jpg" alt="">
        </div>
        <div class="col-lg-6 order-lg-first">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-right">
                <h4 class="text-white">Arquivos</h4>
                <p class="mb-0 text-white-50 text-justify">Aposente os documentos de papel e a poeira acumulada! com o igreja controle você mantém todos os seus arquivos protegidos e disponíveis a todo instante com nosso serviço de armazenamento em nuvem.</p>
                <hr class="d-none d-lg-block mb-0 mr-0">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section> --}}





  <!-- Login Section -->
  {{-- <section id="clients" class="clients-section d-flex bg-black">
    <div class="container my-auto">

      <div class="text-center">

        <div class="col-md-10 col-lg-8 mx-auto text-center">

        <h2 class="text-white-50 mx-auto mt-2 mb-5">Igrejas</h2>

            <div class="owl-carousel" style="padding-bottom: 50px"> --}}
                {{-- @forelse($churches as $key => $church)
                    <!-- <a target="_blank" href="https://www.google.com/maps?q=loc:{{ $church->lat }},{{ $church->long }}" class="text-center"> -->
                      <a target="_blank" href="{{ env('APP_URL').'/'.$church->site_url }}" class="text-center">
                        <img style="border-radius: 50%; cursor: pointer;" src="@if(!is_null($church->avatar)){{ url('storage/churches/'.$church->avatar) }} @else {{ url('storage/churches/default.jpg') }} @endif" alt="{{$church->name}}" >
                        <span style="color: white">{{$church->name}}</span>
                    </a>
                @empty
                @endforelse --}}
            {{-- </div>

        </div>


      </div>

    </div>
  </section> --}}


  <!-- Login Section -->
<section id="plans" class="plans-section d-flex bg-light">
    <div class="container my-auto">

      <div class="text-center">

        <div class="col-md-10 col-lg-8 mx-auto text-center">

        <h2 class="text-black-50 mx-auto mt-2 mb-5">Nos contate até o contador chegar à 0, temos uma oportunidade para você!</h2>

            <div class="clock" style="display: flex; justify-content: center;"></div>

        </div>


      </div>

    </div>
</section>



  <!-- Login Section -->
  <section id="login" class="signup-section d-flex">
    <div class="container">
      <div class="row">
        <div class="mx-auto text-center">

            <h2 class="text-white-50 mx-auto mt-2 mb-5">Login</h2>

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

                </div>
                <button type="submit" class="btn btn-primary mx-auto" style="background-color: #3c8dbc">Entrar</button>
            </form>

            @if(session('error'))
                <br>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-ban"></i> {{session('error')}}
                </div>
            @endif

        </div>
      </div>
    </div>
  </section>


  <!-- Contact Section -->
  {{-- <section id="contact" class="contact-section bg-black" style="color: #3c8dbc">
    <div class="container">

        <h2 class="text-white-50 mx-auto mt-2 mb-5 text-center">Contato</h2>

      <div class="row">

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100" style="border-bottom-color: #3c8dbc">
            <div  class="card-body text-center">
              <i class="fas fa-map-marked-alt text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Endereço</h4>
              <hr class="my-4">
              <div class="small text-black-50">Avenida Gov. Carlos Lindemberg, 1121</div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100" style="border-bottom-color: #3c8dbc">
            <div  class="card-body text-center">
              <i class="fas fa-envelope text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Email</h4>
              <hr class="my-4">
              <div class="small text-black-50">
                <a href="#">jf.britto@teste.com</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100" style="border-bottom-color: #3c8dbc">
            <div  class="card-body text-center">
              <i class="fas fa-mobile-alt text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Telefone</h4>
              <hr class="my-4">
              <div class="small text-black-50">(28) 99974-3099</div>
            </div>
          </div>
        </div>
      </div>

      <div class="social d-flex justify-content-center">
        <a href="#" class="mx-2">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-github"></i>
        </a>
      </div>

    </div>
  </section> --}}

  <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
      Copyright &copy; WeBianchi {{date('Y')}}
    </div>
  </footer>

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
