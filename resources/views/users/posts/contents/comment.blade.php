<div class="mt-3">

    @if ($post->comments->isNotEmpty())
    <hr>
        <ul class="list-group mt-2">
            @foreach ($post->comments->take(3) as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="{{route('profile.show', $comment->user->id)}}" class="text-decoration-none text-dark fw-bold"> {{ $comment->user->name }} </a>
                    &nbsp;
                    <p class="d-inline fw-light">{{ $comment->body }}</p>
                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                        @if ($comment->user_id == Auth::id())
                            &middot;
                            <button type="submit" class="border-0 btn text-danger shadow-none p-0">Delete</button>
                        @endif
                    </form>
                    @if ($loop->last AND $post->comments->count() > 3)
                        <li class="list-group-item border-0 p-0 mb-2">
                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">View all comments ({{$post->comments->count()}}) </a>
                </li>
            @endif
            </li>
    @endforeach
    </ul>
    @endif

    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf
        <div class="input-group">
            <textarea name="body" id="" rows="1" class="form-control form-control-sm" placeholder="Add a comment"></textarea>
            <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
        </div>
    </form>
</div>
