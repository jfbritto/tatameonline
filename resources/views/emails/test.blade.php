<html>
    <body>
        <p>Olá, {{ $user->name }}!</p>
        <p></p>
        <p>Seja bem vindo ao time da <strong>X</strong>, teremos uma longa jornada pela frente!</p>
        <p>Segue abaixo seu login e senha para acesso à plataforma!</p>

        <p>Login: {{ $user->email }}</p>
        <p>Senha: {{ $user->password }}</p>
        <p>Plataforma: <a target="_blank" href="https://www.tatameonline.com.br/#login">www.tatameonline.com.br</a></p>

        <p>Att, <br>
        Equipe TaTame Online!</p>
    </body>
</html>
