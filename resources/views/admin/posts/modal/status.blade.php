{{-- hide --}}
<div class="modal fade" id="hide-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i>
                    Hide Post
                </h5>
            </div>
            <div class="modal-body">
                Are you sure you want to hide this post?
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="{{ $post->id }} cl
                    image-lg" class="w-100">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- unhide --}}
<div class="modal fade" id="unhide-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h5 class="modal-title text-primary">
                    <i class="fa-solid fa-user-slash"></i>
                    Unhide Post
                </h5>
            </div>
            <div class="modal-body">
                Are you sure you want to unhide this post?
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="{{ $post->id }} cl
                    image-lg" class="w-100">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-primary btn-sm"  data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>
