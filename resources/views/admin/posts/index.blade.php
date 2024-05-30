@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-primary text-secondary">
        <tr>
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($all_posts as $post)
        <tr>
            <td class="text-end">
                {{ $post->id }}
            </td>
            <td>
                <a href="{{ route('post.show', $post->id) }}">
                    <img src="{{ $post->image }}" alt="" class="image-lg mx-auto d-block">
                </a>
            </td>
            <td>
            @foreach($post->categories as $category)
                <span class="badge bg-secondary bg-opacity-50">{{ $category->name }}</span>
            @endforeach
            </td>
            <td>
                <a href="" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
            </td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>
            @if ($post->trashed())
                <i class="fa-solid fa-circle-minus text-secondary"></i> &nbsp; Hidden
            @else
                <i class="fa-solid fa-circle text-primary"></i> &nbsp; Visible
            @endif

            </td>
            <td>
                <div class="dropdown">

                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>

                    <div class="dropdown-menu">
                    @if ($post->trashed())
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-{{ $post->id }}">
                            <i class="fa-solid fa-eye"></i>
                            Unhide Post {{ $post->id }}
                        </button>
                    @else
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-{{ $post->id }}">
                            <i class="fa-solid fa-eye-slash"></i>
                            Hide Post {{ $post->id }}
                        </button>
                    @endif
                    </div>
                </div>
            </td>
            @include('admin.posts.modal.status')
        </tr>
    @endforeach

    </tbody>
</table>



@endsection
