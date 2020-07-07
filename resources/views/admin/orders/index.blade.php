@extends('layouts.app')
    @section('content')

        <h3>Pedidos</h3>
        <hr>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuário</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            {{$order->id}}
                        </td>
                        <td>
                            {{$order->user->name}}
                        </td>
                        <td>
                            {{date('d/M/Y H:i:s', strtotime($order->created_at))}}
                        </td>
                        <td>
                            {{$order->pagseguro_status}}
                        </td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-4"></div>
            {{$orders->links()}}
            <div class="col-md-4"></div>
        </div>
    @endsection