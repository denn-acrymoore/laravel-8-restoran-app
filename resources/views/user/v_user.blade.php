@extends('layouts.adminlte')
@section('title', 'User')

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
        <a href="/user/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add User
        </a>
    </div>

    <style>
        td {
            word-wrap: break-word;
        }

        th {
            word-wrap: break-word;
        }
    </style>


    <div class="table-responsive-md">
        <table class="table table-bordered table-striped" style="table-layout: fixed;">
            <thead class="thead-dark">
            <tr>
                <th> User ID </th>
                <th> First Name </th>
                <th> Last Name </th>
                <th> Username </th>
                <th> Password </th>
                <th> salt </th>
                <th> Birth Date </th>
                <th> Sex </th>
                <th> Type </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($user as $data)
                    <tr>
                        <td>{{ $data->user_id }}</td>
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->password }}</td>
                        <td>{{ $data->salt }}</td>
                        <td>{{ $data->birth_date }}</td>
                        <td>{{ $data->sex }}</td>
                        <td>{{ $data->type }}</td>
                        <td>
                            <a href="/user/edit/{{ $data->user_id }}" class="btn btn-sm btn-warning">Edit</a>
                            <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#del-confirm{{ $data->user_id }}">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead class="thead-dark">
                <tr>
                    <th> User ID </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Username </th>
                    <th> Password </th>
                    <th> salt </th>
                    <th> Birth Date </th>
                    <th> Sex </th>
                    <th> Type </th>
                    <th> Action </th>
                </tr>
            </thead>
        </table>
    </div>

    @foreach ($user as $data)

        <div class="modal fade" id="del-confirm{{ $data->user_id }}">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $data->username }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this data?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                        <a href="/user/delete/{{ $data->user_id }}" type="button" class="btn btn-outline-light">Yes</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection