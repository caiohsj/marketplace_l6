@extends('layouts.app')
    @section('content')
        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Usuário(Dono)</th>
                    <th>Total de Produtos</th>
                    <th>
                        @if (empty($stores))
                            <a href="{{route('admin.stores.create')}}" class="btn btn-success btn-sm">+</a>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stores as $store)
                    <tr>
                        <td>
                            {{$store->id}}
                        </td>
                        <td>
                            {{$store->name}}
                        </td>
                        <td>
                            {{$store->description}}
                        </td>
                        <td>
                            {{$store->user->name}}
                        </td>
                        <td>
                            {{$store->products->count()}}
                        </td>
                        <td>
                            <a href="{{route('admin.stores.edit',['store'=>$store->id])}}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{route('admin.stores.destroy',['store'=>$store->id])}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Excluir" class="btn btn-danger btn-sm"/>
                            </form>
                        </td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
    @endsection