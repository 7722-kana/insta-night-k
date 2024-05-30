@extends('layouts.app')

@section('title', 'Admin:Users')

@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-center d-block icon-md"></i>
                        @endif

                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>
                        @if ($user->trashed())
                            <i class="fa-regular fa-circle text-secondary"></i> &nbsp; Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i> &nbsp; Active
                        @endif
                    </td>
                    <td>
                        @if ($user->id != Auth::id())
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($user->trashed())
                                        <button class="dropdown-item text-success" data-bs-toggle="modal"
                                            data-bs-target="#activate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-check text-success"></i>Activate {{ $user->name }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deactivate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-slash text-danger"></i>Deactivate {{ $user->name }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </td>
                    <div class="modal fade" id="deactivate-user-{{ $user->id }}">
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
                    <div class="modal fade" id="activate-user-{{ $user->id }}">
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


                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
