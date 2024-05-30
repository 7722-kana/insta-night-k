<div class="modal fade" id="deactivate-{{ $user->id }}">
    <div class="modal-dialog border-danger">
        <div class="modal-content ">
            <div class="modal-header text-danger">
                <h5 class="modal-title" id="modalTitleId">
                    Deactivate User <i class="fa-solid fa-user-slash"></i>
                </h5>

            </div>
            <div class="modal-body">
                <p class="text-danger">
                    Are you sure to deactivate user {{ $user->name }}
                </p>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.users.deactivate',$user->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- activate --}}
<div class="modal fade" id="activate-{{ $user->id }}">
    <div class="modal-dialog border-success">
        <div class="modal-content ">
            <div class="modal-header text-success">
                <h5 class="modal-title" id="modalTitleId">
                    Activate User <i class="fa-solid fa-user-check"></i>
                </h5>

            </div>
            <div class="modal-body">
                <p class="text-success">
                    Are you sure to activate user {{ $user->name }}
                </p>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.users.activate',$user->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>

