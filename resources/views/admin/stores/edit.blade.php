@extends('layouts.app')
    
@section('content')
    <h1 class="display-3 mt-2 text-center">Nova Loja</h1>
    <form action="{{route('admin.stores.update',['store'=>$store->id])}}" method="post" class="mt-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="name" placeholder="Nome da Loja" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{$store->name}}"/>
        @error('name')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="description" placeholder="Descrição da Loja" class="form-control mb-2 @error('description') is-invalid @enderror" value="{{$store->description}}"/>
        @error('description')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="phone" placeholder="Telefone da Loja" class="form-control mb-2 @error('phone') is-invalid @enderror" value="{{$store->phone}}"/>
        @error('phone')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        @if ($store->logo)
            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo"/>
        @endif
        <div class="form-group">
            <label for=""></label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
        </div>
        @error('logo')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="mobile_phone" placeholder="Celular" class="form-control mb-1 @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}"/>
        @error('mobile_phone')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="submit" value="Enviar" class="btn btn-success btn-block">
    </form>
@endsection