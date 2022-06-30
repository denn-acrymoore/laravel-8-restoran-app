@extends('layouts.adminlte')
@section('title', 'Detail Product')
@section('content')

<table class="table">
    <tr>
        <th width="150px"> Product Id </th>
        <th width="30px">:</th>
        <th>{{ $product->product_id }}</th>
    </tr>
    <tr>
        <th width="150px"> Product Name </th>
        <th width="30px">:</th>
        <th>{{ $product->name }}</th>
    </tr>
    <tr>
        <th width="150px"> Price </th>
        <th width="30px">:</th>
        <th>{{ $product->price }}</th>
    </tr>
    <tr>
        <th width="150px"> Description </th>
        <th width="30px">:</th>
        <th>{{ $product->description }}</th>
    </tr>
    <tr>
        <th width="150px"> Category </th>
        <th width="30px">:</th>
        <th>{{ $product->category }}</th>
    </tr>
    <tr>
        <th width="150px"> Picture </th>
        <th width="30px">:</th>
        <th><img src="{{ asset('product_images/' . $product->picture) }}" width="400px"></th>
    </tr>

    <tr>
        <th colspan="3"><a href="/product" class="btn btn-success btn-sm">Back</a></th>
    </tr>
</table>

@endsection