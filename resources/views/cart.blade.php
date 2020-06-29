@extends('layouts/front')

@section('content')
    <h2>Carrinho</h2>
    <hr>
    <div class="row">
        <table class="table col-12">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>SubTotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0.0;
                @endphp
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product['name']}}</td>
                        <td>R$ {{number_format($product['price'], 2, ',', '.')}}</td>
                        <td>{{$product['amount']}}</td>
                        @php
                            $subTotal = $product['price'] * $product['amount'];
                            $total += $subTotal;
                        @endphp
                        <td>R$ {{number_format($subTotal, 2, ',', '.')}}</td>
                        <td>
                            <a href="{{route('cart.remove', ['slug' => $product['slug']])}}" class="btn btn-danger btn-sm">REMOVER</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Total: </td>
                    <td colspan="2" class="bg-info text-white">R$ {{number_format($total, 2, ',', '.')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <a href="{{route('cart.cancel')}}" class="btn btn-secondary btn-lg">Cancelar Compra</a>
        <a href="{{route('checkout.index')}}" class="btn btn-success btn-lg ml-auto">Concluir Compra</a>
    </div>
@endsection