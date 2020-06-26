@extends('layouts/front')

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="card" style="width: 18rem; margin: 2rem;">
                @if ($product->photos->count())
                    <img class="card-img-top" src="{{asset('storage/'.$product->photos->first()->image)}}" alt="Produto">
                @else
                    <img class="card-img-top" src="{{asset('img/not-found.png')}}" alt="Not Found">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{$product->description}}</p>
                    <a href="#" class="btn btn-primary">Comprar</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection