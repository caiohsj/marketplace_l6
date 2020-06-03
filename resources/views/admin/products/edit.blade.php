@extends('layouts.app')
    
@section('content')
    <h1 class="display-3 mt-2 text-center">Nova Loja</h1>
    <form action="{{route('admin.products.update',['product'=>$product->id])}}" method="post" class="mt-3">
        @csrf
        @method('PUT')
        <input type="text" name="name" placeholder="Nome do Produto" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{$product->name}}"/>
        @error('name')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="description" placeholder="Descrição do Produto" class="form-control mb-2 @error('description') is-invalid @enderror" value="{{$product->description}}"/>
        @error('description')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="price" placeholder="Preço" class="form-control mb-2 @error('price') is-invalid @enderror" value="{{$product->price}}"/>
        @error('price')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <input type="text" name="slug" placeholder="Slug" class="form-control mb-2 @error('slug') is-invalid @enderror" value="{{$product->slug}}"/>
        @error('slug')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <textarea name="body" id="bodyProduct" cols="30" rows="10" class="form-control mb-2 @error('body') is-invalid @enderror" placeholder="Conteúdo">{{$product->body}}</textarea>
        @error('body')
            <div class="invalid-feedback mb-3">
                {{$message}}
            </div>
        @enderror
        <select name="categories[]" id="" class="form-control mb-2" multiple>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif>{{$category->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Enviar" class="btn btn-success btn-block">
    </form>
@endsection