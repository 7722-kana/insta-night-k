<div class="modal fade" id="delete-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="fa-regular fa-trash-can"></i>
                    Delete Category
                </h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?
                <p>This action will affect all the posts under this category. Posts wihtout category will fall under Uncategorized.</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.delete', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h5 class="modal-title text-warning">
                    <i class="fa-regular fa-pen-to-square"></i>
                    Edit Category
                </h5>
            </div>
            <div class="modal-body">
                <input type="text" name="new_name" id="new_name" class="form-control" placeholder="Category name" value="{{ $category->name }}">
                <p>This action will affect all the posts under this category. Posts wihtout category will fall under Uncategorized.</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-warning btn-sm"  data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
