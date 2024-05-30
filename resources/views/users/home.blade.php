@extends('layouts.app')

@section('title', 'Home page')

@section('content')
    <div class="row">
        <div class="col-8">
            @forelse ($all_posts as $post)
                <div class="card mb-4">
                    {{-- title  --}}
                    @include('users.posts.contents.title')

                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                <div class="text-center">
                    <h2>Share photos</h2>
                    <p class="text-muted">
                        When you share photos, they'll appear on your profile
                    </p>
                    <a href="{{route('post.create')}}" class="text-decoration-none">
                            Share your first photo
                    </a>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    <a href="">
                    @if ($post->user)
                        @if ($post->user->avatar)
                            <img src="{{$post->user->avatar}}" alt="" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user icon-md text-secondary"></i>
                        @endif
                    @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>

            @if ($suggested_users)
                <div class="row">
                    <div class="col-auto">
                        <p class="fw-bold text-secondary">Suggestions for you</p>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="text-decoration-none text-dark fw-bold">See all</a>
                    </div>
                </div>
                @foreach ($suggested_users as $user)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            @if ($user->avatar)
                                <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="{{route('profile.show',$user->id)}}" class="text-decoration-none text-dark fw-bold">{{$user->name}}</a>
                        </div>
                        <div class="col-auto">
                            <form action="{{route('follow.store',$user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="border-0 btn p-0 text-primary btn-sm">Follow</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
@endsection
