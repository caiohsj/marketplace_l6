@extends('layouts.app')
    @section('content')
        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th><a href="{{route('admin.categories.create')}}" class="btn btn-success btn-sm">+</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{$category->id}}
                        </td>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            {{$category->description}}
                        </td>
                        <td>
                            <a href="{{route('admin.categories.edit',['category'=>$category->id])}}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{route('admin.categories.destroy',['category'=>$category->id])}}" method="post" class="d-inline">
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
            {{$categories->links()}}
            <div class="col-md-4"></div>
        </div>
    @endsection