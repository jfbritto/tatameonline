<html>
    <header>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap4.min.css" rel="stylesheet">
    </header>
    <body>

        <div class="container">
            <p>Olá, {{ $user->name }}!</p>
            <p></p>
            <p>Acabamos de confirmar seu pagamento!</p>

            <p>Valor: R$ {{ number_format($invoice->value, 2, ',', '.') }}</p>
            <p>Vencimento: {{ date("d/m/Y", strtotime($invoice->dueDate)) }}</p>

            {{-- <p>Acesse seu recibo online <a target="_blank" href="https://www.tatameonline.com.br/#login">Aqui</a></p> --}}
            <p>Acesse seu recibo online <a target="_blank" href="http://tatameonline.local/payment/{{$invoice->tokenPayment}}">Aqui</a></p>

            <p>Att, <br>
                Equipe TaTame Online!</p>
        </div>

    </body>
</html>
