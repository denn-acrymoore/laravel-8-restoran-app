@extends('layouts.adminlte')
@section('title', 'Edit User')

@section('content')
<form action="/user/edit/submit/{{ $user->user_id }}" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">

      <div class="form-group">
        <label for="first_name">First Name: </label>
        <input type="text" name="first_name" 
        class="form-control @error('first_name') is-invalid @enderror"
        value="{{ $user->first_name }}">
        <div class="invalid-feedback">
          @error('first_name'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <label for="last_name">Last Name: </label>
        <input type="text" name="last_name" 
        class="form-control @error('last_name') is-invalid @enderror"
        value="{{ $user->last_name }}">
        <div class="invalid-feedback">
          @error('last_name'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <label for="username">Username: </label>
        <input type="text" name="username" 
        class="form-control @error('username') is-invalid @enderror"
        value="{{ $user->username }}">
        <div class="invalid-feedback">
          @error('username'){{ $message }}@enderror
        </div>
      </div>
      

      <div class="form-group">
        <label for="password_input">Password: </label>
        <input type="password" name="password_input" 
        class="form-control @error('password_input') is-invalid @enderror">
        <div class="invalid-feedback">
          @error('password_input'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <label for="confirm_password">Confirm Password: </label>
        <input type="password" name="confirm_password" 
        class="form-control @error('confirm_password') is-invalid @enderror">
        <div class="invalid-feedback">
          @error('confirm_password'){{ $message }}@enderror
        </div>
      </div>

      
      <div class="form-group">
        <label for="birth_date">Birth Date: </label>
        <input type="date" name="birth_date" 
        class="form-control @error('birth_date') is-invalid @enderror"
        value="{{ $user->birth_date }}">
        <div class="invalid-feedback">
          @error('birth_date'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <label for="sex">Sex: </label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sex" id="option_male" 
            value="Male" 
            @if ($user->sex === "Male") 
                checked
            @endif
            >
            <label class="form-check-label" for="option_male">
              Male
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sex" id="option_female" 
            value="Female" 
            @if ($user->sex === "Female") 
                checked
            @endif
            >
            <label class="form-check-label" for="option_female">
              Female
            </label>
          </div>
          <div class="text-danger" style="font-size: 13px">
            @error('sex'){{ $message }}@enderror
          </div>
      </div> 


      <div class="form-group">
        <label for="type">User Type: </label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="option_user" 
            value="user" 
            @if ($user->type === "user") 
                checked
            @endif
            >
            <label class="form-check-label" for="option_user">
              User
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="option_admin" 
            value="admin" 
            @if ($user->type === "admin") 
                checked
            @endif
            >
            <label class="form-check-label" for="option_admin">
              Admin
            </label>
          </div>
          <div class="text-danger" style="font-size: 13px">
            @error('type'){{ $message }}@enderror
          </div>
      </div>   
      

      <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
      </div>

    </div>
  </form>
@endsection