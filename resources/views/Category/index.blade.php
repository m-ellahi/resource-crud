@extends('layouts.app')
@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<a class="text-white btn btn-success mb-2" href="{{ URL::to('category/create')}}">Add Category</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $category->name }}</td>
            <td>
              <a href="{{ URL::to('category/' . $category->id) }}"><i class="text-success fs-5 fa-regular fa-eye"></i></a>
              <a href="{{ URL::to('category/' . $category->id . '/edit') }}"><i class="text-warning fs-5 fa-regular fa-pen-to-square mx-2"></i></a> 
              <form action="{{ URL::to('category/' . $category->id)  }}" method="POST" class="delete-form" style="display:inline;">
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
            <td colspan="3">No category added yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection