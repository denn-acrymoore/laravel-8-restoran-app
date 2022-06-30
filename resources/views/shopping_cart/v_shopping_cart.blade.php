@extends('layouts.adminlte')
@section('title', 'Shopping Cart')

@section('content')

    @if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!!!</h4>
        {{ session('success') }}
    </div>
    @endif

    @if (session('failed'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-close"></i> Error!!!</h4>
        {{ session('failed') }}
    </div>
    @endif

    <div class="float-right" style="margin-bottom: 10px;">
        <a href="/shopping_cart/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add Shopping Cart
        </a>
    </div>

    <table class="table table-bordered">
        <thead class="thead-dark"> 
        <tr>
            <th> Shopping Cart ID </th>
            <th> User ID </th>
            <th> Product ID </th>
            <th> Quantity </th>
            <th> Total </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($shopping as $data)
                <tr>
                    <td>{{ $data->shopping_cart_id }}</td>
                    <td>{{ $data->user_id }}</td>
                    <td>{{ $data->product_id }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{ $data->total }}</td>
                    <td>
                        <a href="/shopping_cart/edit/{{ $data->shopping_cart_id }}" 
                        class="btn btn-sm btn-warning">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                        data-target="#del-confirm{{ $data->shopping_cart_id }}">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <thead class="thead-dark">
            <tr>
                <th> Shopping Cart ID </th>
                <th> User ID </th>
                <th> Product ID </th>
                <th> Quantity </th>
                <th> Total </th>
                <th> Action </th>
            </tr>
        </thead>
    </table>


    @foreach ($shopping as $data)

        <div class="modal fade" id="del-confirm{{ $data->shopping_cart_id }}">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Shopping Card ID {{ $data->shopping_cart_id }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this data?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                        <a href="/shopping_cart/delete/{{ $data->shopping_cart_id }}" type="button" class="btn btn-outline-light">Yes</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection