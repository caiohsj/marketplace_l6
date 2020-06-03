@extends('layouts.app')
    
@section('content')
    <h1 class="display-3 mt-2 text-center">Nova Categoria</h1>
    <form action="{{route('admin.categories.store')}}" method="post" class="mt-3">
        @csrf
        <input type="text" name="name" placeholder="Nome da Categoria" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{old('name')}}"/>
        @error('name')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="description" placeholder="Descrição da Categoria" class="form-control mb-2 @error('description') is-invalid @enderror" value="{{old('description')}}"/>
        @error('description')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="slug" placeholder="Slug" class="form-control mb-2 @error('slug') is-invalid @enderror" value="{{old('slug')}}"/>
        @error('slug')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="submit" value="Enviar" class="btn btn-success btn-block">
    </form>
@endsection