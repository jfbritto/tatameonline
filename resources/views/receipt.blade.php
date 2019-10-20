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


            @if($invoice != '')

                <div class="card text-center">
                    <div class="card-header">
                        Fatura paga com sucesso!
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$invoice->user->name}}</h5>
                        <p class="card-text">Vencimento: <strong>{{date("d/m/Y", strtotime($invoice->dueDate))}}</strong></p>
                        <p class="card-text">Pagamento: <strong>{{date("d/m/Y", strtotime($invoice->paymentDate))}}</strong></p>
                        <p class="card-text">Código de recebimento: <strong>{{$invoice->tokenPayment}}</strong></p>
                        <a href="{{env('APP_URL')}}" class="btn btn-info">Ir para site</a>
                    </div>
                    <div class="card-footer text-muted">
                        {{$invoice->user->academy->name}}
                    </div>
                </div>

            @else
                <p>Pagamento não encontrado!</p>
            @endif
        </div>

</body>
</html>
