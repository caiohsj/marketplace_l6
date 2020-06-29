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
                            <label for="card_number">Número do Cartão</label>
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
                </div>
            </form>
        </div>
    </div>
@endsection