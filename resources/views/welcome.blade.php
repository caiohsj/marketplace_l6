@extends('layouts/front')

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="card" style="width: 18rem; margin: 2rem;">
                @if ($product->photos->count())
                    <img class="card-img-top" src="{{asset('storage/'.$product->thumb)}}" alt="Produto">
                @else
                    <img class="card-img-top" src="{{asset('img/not-found.png')}}" alt="Not Found">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h6>R$ {{number_format($product->price, 2, ',', '.')}}</h3>
                <p class="card-text">{{$product->description}}</p>
                    <a href="{{route('single', ['slug' => $product->slug])}}" class="btn btn-info">Info</a>
                </div>
            </div>
        @endforeach
    </div>
    <h2>Lojas Destaques</h2>
    <hr>
    <div class="row">
        @foreach ($stores as $store)
        <div class="card" style="width: 18rem; margin: 2rem;">
            @if ($store->logo)
                <img class="card-img-top" src="{{asset('storage/'.$store->logo)}}" alt="Produto">
            @else
                <img class="card-img-top" src="{{asset('img/not-found.png')}}" alt="Not Found">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$store->name}}</h5>
                <p class="card-text">{{$store->description}}</p>
                <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-info">Info</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection