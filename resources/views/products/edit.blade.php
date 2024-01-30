
@extends('layouts.app');
@section('main')
    <div class="container mt-5 col-md-6">
        <div class="justify-content-center">
        <form class="card p-4 mt-4" action="/products/{{$product->id}}/update" method="POST" enctype="multipart/form-data">
            <h3  class="text-dark">Edit Product #{{$product->name}}</h3>
            @csrf
            @method('PUT')
            <div class=" mb-3 mt-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" class="form-control" value="{{ old('name', $product->name) }}" id="name" placeholder="Enter name" name="name">
                
                @if($errors->has('name'))
                    <span class="text-danger">
                        {{ $errors->first('name') }} 
                    </span>
                @endif
                
            </div>
            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" rows="4" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">
                        {{ $errors->first('description') }} 
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($errors->has('image'))
                    <span class="text-danger">
                        {{ $errors->first('image') }} 
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
          </form>
        </div>
    </div>
@endsection