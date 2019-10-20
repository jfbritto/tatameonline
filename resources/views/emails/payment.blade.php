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
                    <p class="card-text">Acabamos de confirmar seu pagamento!</p>
                    <p class="card-text">Valor: R$ <strong>{{ number_format($invoice->value, 2, ',', '.') }}</strong></p>
                    <p class="card-text">Vencimento: <strong>{{ date("d/m/Y", strtotime($invoice->dueDate)) }}</strong></p>
                    <p class="card-text"><a href="{{env('APP_URL')}}/payment/{{$invoice->tokenPayment}}" class="btn btn-info">Recibo Online</a></p>

                </div>
                <div class="card-footer text-muted">
                    Att,<br>{{$invoice->user->academy->name}}
                </div>
            </div>

        </div>

</body>
</html>
