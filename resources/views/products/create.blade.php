
@extends('layouts.app');
@section('main')
    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Successfully created',
            text: 'Wanna create another product?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Add New'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/products/create';
            } else {
                window.location.href = '/';
            }
        });
    </script>
@endif
    <div class="container mt-5 col-md-6">
        <div class="justify-content-center">
        <form class="card p-4 mt-4" action="/products/store" method="POST" enctype="multipart/form-data">
            <h2 class="text-dark">Add New Product</h2>
            @csrf
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter name" name="name">
                
                @if($errors->has('name'))
                    <span class="text-danger">
                        {{ $errors->first('name') }} 
                    </span>
                @endif
                
            </div>
            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" rows="4" id="description" name="description">{{ old('description') }}</textarea>
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
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
        </div>
    </div>
@endsection