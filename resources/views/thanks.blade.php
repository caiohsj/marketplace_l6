@extends('layouts/front')

@section('content')
    <h2>Pedido Concluído</h2>
    <hr>
    <div class="alert alert-success" role="alert">
        Pedido: {{request()->get('order')}}
    </div>
@endsection
