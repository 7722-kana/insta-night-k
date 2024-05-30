@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <div class="row gx-2 mb-4">
        <div class="col-4">
            <input type="text" name="name" id="name" class="form-control" placeholder="Add a category" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-8">
        <table class="table table-hover align-middle bg-white border text-secondary text-center">
            <thead class="small table-warning text-secondary">
                <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>COUNT</th>
                    <th>LAST UPDATE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td class="text-dark">
                        {{ $category->name }}
                    </td>
                    <td>{{ $category->posts()->count() }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-{{ $category->id }}" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#delete-{{ $category->id }}" title="Delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                    @include('admin.categories.modal.delete_edit')
                </tr>
                @endforeach
                <tr>
                        <td colspan="2" class="text-dark">
                            Uncategorized
                            <p class="xsmall mb-0 text-muted">
                                Hidden posts are not included.
                            </p>
                        </td>
                        <td>{{ $uncategorizedCount }}</td>
                        <td colspan="2"></td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

@endsection
