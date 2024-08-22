@extends('layouts.app')
@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-6">
    <form method="post" action="{{URL::to('category')}}">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Category Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>


@endsection