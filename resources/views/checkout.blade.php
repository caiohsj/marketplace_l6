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
                            <label for="card_number">Número do Cartão</label> <span class="brand"></span>
                            <input type="text" name="card_number" id="card_number" class="form-control"/>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="card_month">Mês de Expiração</label>
                            <input type="text" name="card_month" id="card_month" class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="card_year">Ano de Expiração</label>
                            <input type="text" name="card_year" id="card_year" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="card_cvv">CVV</label>
                            <input type="text" name="card_cvv" id="card_cvv" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-12 installments"></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script>
        const sessionId = '{{session()->get('pagseguroSessionCode')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        let divInstallments = document.querySelector('div.installments');
        cardNumber.addEventListener('keyup', function () {
            if (cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function (response) {
                        let imgBrand = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png" />`;
                        spanBrand.innerHTML = imgBrand;
                        getInstallments(100,response.brand.name);
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

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }


            select += '</select>';

            return select;
        }
    </script>
@endsection