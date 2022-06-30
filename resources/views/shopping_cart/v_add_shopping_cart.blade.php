@extends('layouts.adminlte')
@section('title', 'Add Shopping Cart')

@section('content')
<form action="/shopping_cart/add/submit" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">

      <div class="form-group">
        <label for="user_id">User ID: </label>

        @foreach ($user as $data)
          @if ($data->type == "user")
            <div class="form-check">
              <input class="form-check-input" type="radio" name="user_id" id="user_{{ $data->user_id }}" 
              value="{{ $data->user_id }}" 
              @if (old('user_id') === $data->user_id) 
                  checked
              @endif>
              <label class="form-check-label" for="user_{{ $data->user_id }}"">
                {{ $data->user_id }} - {{ $data->username }}
              </label>
            </div>
          @endif
        @endforeach
        
        <div class="text-danger" style="font-size: 13px">
          @error('user_id'){{ $message }}@enderror
        </div>
      </div> 


      <div class="form-group">
        <label for="product_id">Product ID: </label>
        
        @foreach ($product as $data)
          <div class="form-check">
            <input class="form-check-input" type="radio" name="product_id" id="product_{{ $data->product_id }}" 
            value="{{ $data->product_id }}" 
            @if (old('product_id') === $data->product_id) 
                checked
            @endif>
            <label class="form-check-label" for="product_{{ $data->product_id }}">
              {{ $data->product_id }} - {{ $data->name }}
            </label>
          </div>
        @endforeach

        <div class="text-danger" style="font-size: 13px">
          @error('product_id'){{ $message }}@enderror
        </div>
      </div>   
      

      <div class="form-group">
        <label for="quantity">Quantity: </label>
        <input type="number" min=0 name="quantity" 
        class="form-control @error('quantity') is-invalid @enderror"
        value="{{ old('quantity') }}">
        <div class="invalid-feedback">
          @error('quantity'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
      </div>

    </div>
  </form>
@endsection