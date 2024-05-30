<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{$user->avatar}}" alt="" class="rounded-circle shadow d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{$user->name}}</h2>
            </div>
            <div class="col-auto p-2">
                    @if (Auth::id() == $user->id)
                        <a href="{{route('profile.edit')}}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                    @else
                        <form action="#" method="post">
                            @csrf

                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    {{-- ternary operator --}}
                    <strong>{{$user->posts->count()}}</strong> {{ ($user->posts->count() > 1) ? "Posts" : "Post" }}
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>0</strong> Followers
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>0</strong> Following
                </a>
            </div>
        </div>
        <p class="fw-bold">
            {{ ($user->introduction) ? "$user->introduction" : "No Introduction" }}
        </p>
    </div>
</div>
























{{-- <div class="row">
  <div class="col-4">
      @if($user->avatar)
          <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-sm">
      @else
          <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
      @endif
  </div>
  <div class="col-8">
      <div class="row mb-3 ms-1">
          <div class="col-auto">
              <h2 class="display-6 mb-0" > {{ $user->name }} </h2>
          </div>
          @if (Auth::id() == $user->id)
          <div class="col-auto p-2">
              <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
          </div>
          @endif
      </div>
      <div class="row mb-3 ms-1">
          <div class="col-auto">
              <a href="" class="text-decoration-none text-dark">
                  <strong>{{$all_posts->count()}}</strong> posts
              </a>
          </div>
          <div class="col-auto">
              <a href="" class="text-decoration-none text-dark">
                  <strong>{{ $all_followers->count() }}</strong> followers
              </a>
          </div>
          <div class="col-auto">
              <a href="" class="text-decoration-none text-dark">
                  <strong>{{ $all_following->count() }}</strong> following
              </a>
          </div>
      </div>
      <p class="fw-bold ms-3">{{ $user->introduction }}</p>
  </div>
</div>
<div class="mt-5">
  <div class="row">
      @forelse ($all_posts as $post)
      <div class="col-lg-4 col-md-6 mb-4">
          <a href="{{ route('post.show', $post->id) }}">
              <img src="{{ $post->image }}" alt="" class="grid-img">
          </a>
      </div>
      @empty
      @endforelse
  </div>
</div> --}}