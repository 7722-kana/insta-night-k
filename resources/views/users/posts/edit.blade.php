@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                Category <span class="text-muted">(Up to 3)</span>
            </label>
            @foreach ($all_categories as $category)
                @if (in_array($category->id, $selected_categories))
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input" checked>
                        <label for="{{$category->name}}" class="form-check-label"> {{$category->name}} </label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}"
                            class="form-check-input">
                        <label for="{{ $category->name }}" class="form-check-label"> {{ $category->name }} </label>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control" placeholder="Whats on your mind">{{$post->description}}</textarea>
        </div>
        <div class="mb-3">
            <img src="{{$post->image}}" alt="" class="d-block img-thumbnail">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <div class="form-text">
                Acceptable formats: jpeg, png, gif only <br>
                Max file size: 148mb
            </div>
        </div>
        <button type="submit" class="btn btn-primary px-5">Post</button>

    </form>
@endsection
