@extends('layouts/front')

@section('content')
    <h2>Checkout</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="cardNumber">Número do Cartão</label> <span class="brand"></span>
                            <input type="text" name="cardNumber" id="cardNumber" class="form-control"/>
                            <input type="hidden" name="cardBrand"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="cardName">Nome no Cartão</label> <span class="brand"></span>
                            <input type="text" name="cardName" id="cardName" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="card_month">Mês de Expiração</label>
                            <input type="text" name="cardMonth" id="card_month" class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="card_year">Ano de Expiração</label>
                            <input type="text" name="cardYear" id="card_year" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="card_cvv">CVV</label>
                            <input type="text" name="cardCvv" id="card_cvv" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-12 installments"></div>
                </div>

                <button type="button" class="btn btn-success button-checkout">Comprar</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="{{asset('js/jquery.ajax.js')}}"></script>
    <script>
        const sessionId = '{{session()->get('pagseguroSessionCode')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let amountCheckout = {{$total}};
        let cardNumber = document.querySelector('input[name=cardNumber]');
        let spanBrand = document.querySelector('span.brand');
        let divInstallments = document.querySelector('div.installments');
        let buttonCheckout = document.querySelector('button.button-checkout');
        cardNumber.addEventListener('keyup', function () {
            if (cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function (response) {
                        let imgBrand = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png" />`;
                        spanBrand.innerHTML = imgBrand;
                        getInstallments(amountCheckout,response.brand.name);
                        document.querySelector('input[name=cardBrand]').value = response.brand.name;
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            }
        });

        function getInstallments(amount, brand) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function (response) {
                    divInstallments.innerHTML = drawSelectInstallments(response.installments[brand]);
                },
                error: function (response) {

                }
            });
        }

        buttonCheckout.addEventListener('click', function() {
            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=cardNumber]').value,
                brand: document.querySelector('input[name=cardBrand]').value,
                cvv: document.querySelector('input[name=cardCvv]').value,
                expirationMonth: document.querySelector('input[name=cardMonth]').value,
                expirationYear: document.querySelector('input[name=cardYear]').value,
                success: function(response) {
                    proccessCheckout(response.card.token);
                },
                error: function(response) {
                    console.log(response)
                }
            });
        });

        function proccessCheckout(token) {
            let data = {
                cardToken: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select-installments').value,
                cardName: document.querySelector('input[name=cardName]').value,
                _token: '{{csrf_token()}}'
            }
            $.ajax({
                type: 'POST',
                url: '{{route("checkout.proccess")}}',
                data: data,
                dataType: 'json',
                success: function(response) {

                }
            });
        }

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control mb-3 select-installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }


            select += '</select>';

            return select;
        }
    </script>
@endsection