@extends('layouts.app')
    
@section('content')
    <h1 class="display-3 mt-2 text-center">Novo Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post" class="mt-3" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Nome do Produto" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{old('name')}}"/>
        @error('name')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="description" placeholder="Descrição do Produto" class="form-control mb-2 @error('description') is-invalid @enderror" value="{{old('description')}}"/>
        @error('description')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="price" placeholder="Preço" class="form-control mb-2 @error('price') is-invalid @enderror" value="{{old('price')}}"/>
        @error('price')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror

        <div class="form-group">
            <label for=""></label>
            <input type="file" name="photos[]" class="form-control" multiple>
        </div>
        
        <textarea name="body" id="bodyProduct" cols="30" rows="10" class="form-control mb-2 @error('body') is-invalid @enderror" placeholder="Conteúdo">{{old('body')}}</textarea>
        @error('body')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <select name="categories[]" id="" class="form-control mb-2" multiple>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Enviar" class="btn btn-success btn-block">
    </form>
@endsection