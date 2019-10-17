<html>
    <header>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap4.min.css" rel="stylesheet">
    </header>
    <body>

        <div class="container">

            @if($invoice != '')
                <p>Fatura paga com sucesso!</p>
                <p>Aluno: <strong>{{$invoice->user->name}}</strong></p>
                <p>Data vencimento: <strong>{{date("d/m/Y", strtotime($invoice->dueDate))}}</strong></p>
                <p>Data pagamento: <strong>{{date("d/m/Y", strtotime($invoice->paymentDate))}}</strong></p>
                <p>Registro de recebimento: <strong>{{$invoice->tokenPayment}}</strong></p>
            @else
                <p>Pagamento não encontrado!</p>
            @endif
        </div>

    </body>
</html>
