@extends('layouts.adminlte')
@section('title', 'Product')

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
        <a href="/product/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add Product
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th> Product ID </th>
            <th> Product Name </th>
            <th> Price </th>
            <th> Description </th>
            <th> Picture </th>
            <th> Category </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($product as $data)
                <tr>
                    <td>{{ $data->product_id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->description }}</td>
                    <td><img src="{{ asset('product_images/' . $data->picture) }}" width="150px"></td>
                    <td>{{ $data->category }}</td>
                    <td>
                        <a href="/product/detail/{{ $data->product_id }}" class="btn btn-sm btn-success">Detail</a>
                        <a href="/product/edit/{{ $data->product_id }}" class="btn btn-sm btn-warning">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                        data-target="#del-confirm{{ $data->product_id }}">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <thead class="thead-dark">
            <tr>
                <th> Product ID </th>
                <th> Product Name </th>
                <th> Price </th>
                <th> Description </th>
                <th> Picture </th>
                <th> Category </th>
                <th> Action </th>
            </tr>
        </thead>
    </table>

    @foreach ($product as $data)

        <div class="modal fade" id="del-confirm{{ $data->product_id }}">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $data->name }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this data?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                        <a href="/product/delete/{{ $data->product_id }}" type="button" class="btn btn-outline-light">Yes</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection