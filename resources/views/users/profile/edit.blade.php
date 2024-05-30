@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data" class="bg-white shadow rounded-3 p-5">
        @csrf
        @method('PATCH')
        <h2 class="h3 mb-3 fw-light text-muted">Update Profile</h2>

        <div class="row mb-3">
            <div class="col-4">
                @if ($user->avatar)
                    <img src="{{$user->avatar}}" alt="" class="rounded-circle img-thumbnail d-block mx-auto ">
                @else
                    <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                @endif
            </div>
            <div class="col-auto align-self-end">
                <input type="file" name="avatar" id="" class="form-control form-control-sm mt-1">
                <div class="form-text">
                    Acceptable formats: jpeg, jpg, png, gif only <br>
                    Max file size is 1048kb
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="introduction" class="form-label fw-bold">Introduction</label>
            <textarea name="introduction" id="introduction"  rows="5" class="form-control">{{$user->introduction}}</textarea>
        </div>
        <button type="submit" class="btn btn-warning px-5">Save</button>
    </form>

@endsection