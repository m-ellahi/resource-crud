@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <h4>Product Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                    @if($product->product_image)
                            <img class="img-fluid w-25 rounded" src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                    @else
                            <p>No image available</p>
                    @endif
                    </div>
                    
                    <dl class="row">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $product->product_name }}</dd>

                        <dt class="col-sm-3">Category</dt>
                        <dd class="col-sm-9">{{ $product->category->name }}</dd>

                        <dt class="col-sm-3">Price</dt>
                        <dd class="col-sm-9">${{ number_format($product->price, 2) }}</dd>

                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9">{{ $product->description ?? 'No description available' }}</dd>
                    </dl>

                    <a href="{{ URL::to('product/' . $product->id . '/edit') }}" class="btn btn-warning">Edit</a>
                    <a href="{{URL::to('product')}}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
