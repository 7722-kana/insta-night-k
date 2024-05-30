
<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    Delete post
                </h5>
            </div>
            <div class="modal-body">
                <p class="text-danger">Are you sure to delete post id {{$post->id}} </p>
                <img src="{{ $post->image }}" alt="" class="img-thumbnail">
            </div>
            <div class="modal-footer">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

