@extends('layouts.app')
@section('content')

@if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
@endif
<a class="text-white btn btn-success mb-2" href="{{ URL::to('product/create')}}">Add Product</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>
            <img style="width: 150px;height:150px;" class="rounded-circle" src="{{ asset('storage/'.$product->product_image) }}"/>    
            </td>
            <td>
            <a href="{{ URL::to('product/' . $product->id) }}"><i class="text-success fs-5 fa-regular fa-eye"></i></a>
              <a href="{{ URL::to('product/' . $product->id . '/edit') }}"><i class="text-warning fs-5 fa-regular fa-pen-to-square mx-2"></i></a> 
              <form action="{{ URL::to('product/' . $product->id)  }}" method="POST" class="delete-form" style="display:inline;">
              @csrf
              @method('DELETE')
                <button type="submit" class="text-danger bg-transparent border-0" style="background: none; border: none; cursor: pointer;">
                    <i class="fs-5 fa-regular fa-trash-can"></i>
                </button>
              </form>
             
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No Product added yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection