<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    protected $follow;

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    public function store($following_id)
    {
        $this->follow->follower_id = Auth::id();
        $this->follow->following_id = $following_id;
        $this->follow->save();

        return redirect()->back();
    }

    public function destroy($following_id)
    {
        $this->follow->where('follower_id', Auth::id())
            ->where('following_id', $following_id)
            ->delete();

        return redirect()->back();
    }
}
