<html>
    <header>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap4.min.css" rel="stylesheet">
    </header>
    <body>

        <div class="container">
            <p>Olá, {{ $user->name }}!</p>
            <p></p>
            <p>Seja bem vindo ao time da <strong>{{ $academy }}</strong>, teremos uma longa jornada pela frente!</p>
            <p>Segue abaixo seu login e senha para acesso à plataforma!</p>

            <p>Login: <strong>{{ $user->email }}</strong></p>
            <p>Senha: <strong>{{ $password }}</strong></p>
            <p>Plataforma: <a target="_blank" href="https://www.tatameonline.com.br/#login">www.tatameonline.com.br</a></p>

            <p>Att, <br>
                Equipe TaTame Online!</p>
        </div>

    </body>
</html>
