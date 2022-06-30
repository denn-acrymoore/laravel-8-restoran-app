@extends('layouts.adminlte')
@section('title', 'Add Product')

@section('content')
<form action="/product/add/submit" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">

      <div class="form-group">
        <label for="name">Product Name: </label>
        <input type="text" name="name" 
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') }}">
        <div class="invalid-feedback">
          @error('name'){{ $message }}@enderror
        </div>
      </div>
      

      <div class="form-group">
        <label for="price">Product Price (Rupiah): </label>
        <input type="number" name="price"
        class="form-control @error('price') is-invalid @enderror"
        value="{{ old('price') }}">
        <div class="invalid-feedback">
          @error('price'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <label for="description">Product Description: </label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
        rows="4" cols="50"
        maxlength="240">{{ old('description') }}</textarea>
        <div class="invalid-feedback">
          @error('description'){{ $message }}@enderror
        </div>
      </div>


      <div class="form-group">
        <label for="category">Category: </label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="category" id="option_food" 
            value="food" 
            @if (old('category') === "food") 
                checked
            @endif>
            <label class="form-check-label" for="option_food">
              Food
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="category" id="option_drink" 
            value="drink" 
            @if (old('category') === "drink") 
                checked
            @endif>
            <label class="form-check-label" for="option_drink">
              Drink
            </label>
          </div>
          <div class="text-danger" style="font-size: 13px">
            @error('category'){{ $message }}@enderror
          </div>
      </div>
      

      <div class="form-group">
        <label for="picture">Product Picture: </label>
        <input type="file" name="picture" 
        class="form-control-file @error('picture') is-invalid @enderror">
        <div class="invalid-feedback">
          @error('picture'){{ $message }}@enderror
        </div>
      </div>
      
      

      <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
      </div>

    </div>
  </form>
@endsection