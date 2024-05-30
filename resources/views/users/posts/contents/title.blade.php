<div class="card-header bg-white py-3">
    <div class="row align-items-center">
        <div class="col-auto">
            {{-- photo --}}
            @if ($post->user->avatar)
                <img src="{{$post->user->avatar}}" alt="" class="rounded-circle avatar-sm">
            @else
                <i class="fa-solid fa-circle-user icon-sm"></i>
            @endif
        </div>
        <div class="col ps-0">
            {{-- name --}}
            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark"> {{ $post->user->name }} </a>
        </div>
        <div class="col-auto">
            {{-- button --}}
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                <div class="dropdown-menu">
                    @if (Auth::id() === $post->user->id)
                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-solid fa-trash"></i>Delete
                        </button>
                    @else
                        @if ($post->user->isFollowed())
                        <form action="{{route('follow.destroy',$post->user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btnshadow-none dropdown-item text-danger">Unfollow</button>
                        </form>
                        @else
                        <form action="{{route('follow.store',$post->user->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btnshadow-none dropdown-item text-primary">Follow</button>
                        </form>
                        @endif

                    @endif
                </div>
            </div>
            @include('users.posts.contents.modal.delete')
        </div>

    </div>
</div>
