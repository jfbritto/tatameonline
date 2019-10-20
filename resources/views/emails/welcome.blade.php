<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap core CSS -->
        <link href="{{env('APP_URL')}}/css/bootstrap4.min.css" rel="stylesheet">
</header>
<body>

        <div class="container" style="margin-top:20px">

            <div class="card text-center">
                <div class="card-header">
                    Olá, {{ $user->name }}!
                </div>
                <div class="card-body">
                    <h5 class="card-title">Seja bem vindo ao time da <strong>{{ $academy }}</strong>, teremos uma longa jornada pela frente!</h5>
                    <p class="card-text">Segue abaixo seu login e senha para acesso à plataforma!</p>

                    <p class="card-text">Login: <strong>{{ $user->email }}</strong></p>
                    <p class="card-text">Senha: <strong>{{ $password }}</strong></p>

                    <a href="{{env('APP_URL')}}/#login" class="btn btn-info">Plataforma</a>
                </div>
                <div class="card-footer text-muted">
                    {{$user->academy->name}}
                </div>
            </div>

        </div>

</body>
</html>
