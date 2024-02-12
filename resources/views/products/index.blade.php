@extends('layouts.app');
@section('main')
<body>
  @if (session('success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1400
          });
    </script>
@endif

    <div class="container">
        <div class="d-flex justify-content-end">
            <a class="btn btn-dark mt-3" href="products/create">New Product</a>
        </div>

        <div class="container mt-3">
            <h2>All Products</h2>
            <p>All Products will be shown here after succefully added✅</p>            
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index }}</td>
                    {{-- <td>{{ $product->id }}</td> --}}
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset('images/' . $product->image) }}" class="rounded-circle" width="50" height="50" /></td>
                    <td>{{ $product->description }}</td>
                    <td>
                      <a href="products/{{ $product->id }}/show" class="btn btn-primary">View</a>
                      <a href="products/{{ $product->id }}/edit" class="btn btn-success">Edit</a>
                      <form action="/products/{{$product->id}}/delete" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{-- pagination --}}
            <div class="d-flex justify-content-center">
              {{ $products->onEachSide(1)->links() }}
            </div>
        </div>        
    </div>
@endsection