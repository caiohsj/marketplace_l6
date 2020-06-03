@extends('layouts.app')
    
@section('content')
    <h1 class="display-3 mt-2 text-center">Categoria - {{$category->name}}</h1>
    <form action="{{route('admin.categories.update',['category'=>$category->id])}}" method="post" class="mt-3">
        @csrf
        @method('PUT')
        <input type="text" name="name" placeholder="Nome do Produto" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{$category->name}}"/>
        @error('name')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="description" placeholder="Descrição do Produto" class="form-control mb-2 @error('description') is-invalid @enderror" value="{{$category->description}}"/>
        @error('description')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="slug" placeholder="Slug" class="form-control mb-2 @error('slug') is-invalid @enderror" value="{{$category->slug}}"/>
        @error('slug')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="submit" value="Enviar" class="btn btn-success btn-block">
    </form>
@endsection