@extends('layouts.app');
@section('main')
    <div class="container">
    <div class="d-flex mt-5 justify-content-center">
        <img  style="width: 60%; height: 500px;" class="" src="{{ asset('images/' . $product->image) }}" alt="Product image">
        <div class="card-body">
            <h5 style="margin: 20px" class="card-title ml03 mt-6">{{ $product->name }}</h5>
            <p style="margin-left: 20px" class="card-text">{{ $product->description }}</p>
            <a style="margin-left: 20px" href="{{ route('products.index') }}" class="btn btn-primary">Go back</a>
        </div>
    </div>
    </div>
@endsection

