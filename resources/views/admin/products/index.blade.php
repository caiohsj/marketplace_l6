@extends('layouts.app')
    @section('content')
        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th><a href="{{route('admin.products.create')}}" class="btn btn-success btn-sm">+</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            {{$product->id}}
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$product->description}}
                        </td>
                        <td>
                            R$ {{number_format($product->price, 2, ',', '.')}}
                        </td>
                        <td>
                            <a href="{{route('admin.products.edit',['product'=>$product->id])}}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{route('admin.products.destroy',['product'=>$product->id])}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Excluir" class="btn btn-danger btn-sm"/>
                            </form>
                        </td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-4"></div>
            {{$products->links()}}
            <div class="col-md-4"></div>
        </div>
    @endsection