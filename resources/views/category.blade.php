@extends('layouts/front')

@section('content')
    
    <h2>{{$category->name}}</h2>
    <hr>
    
    <div class="row">
        @forelse ($category->products as $product)
            <div class="card" style="width: 18rem; margin: 2rem;">
                @if ($product->photos->count())
                    <img class="card-img-top" src="{{asset('storage/'.$product->photos->first()->image)}}" alt="Produto">
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
        @empty
            <div class="alert alert-info ml-3">Sem produtos :(</div>
        @endforelse
    </div>
@endsection