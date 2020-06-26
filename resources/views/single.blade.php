@extends('layouts/front')

@section('content')
    <div class="row mb-2">
        <div class="col-md-4">
            <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="Produto" class="img-fluid"/>
        </div>
        <div class="col-md-8">
            <h2>{{$product->name}}</h2>
            <h4>{{$product->description}}</h4>
            <h5>R$ {{number_format($product->price, 2, ',', '.')}}</h5>
            <hr>
            <form action="{{route('cart.add')}}" method="POST">
                @csrf
                <input type="hidden" name="product[name]" value="{{$product->name}}">
                <input type="hidden" name="product[price]" value="{{$product->price}}">
                <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                <input type="number" name="product[amount]" id="amount" value="1" class="form-control mb-2 col-md-2 col-sm-6 col-8"/>
                <button type="submit" class="btn btn-success">Comprar</button>
            </form>
        </div>
    </div>

    <div class="row">
        {{$product->body}}
    </div>
@endsection