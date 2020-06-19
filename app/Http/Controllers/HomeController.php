<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog;
use App\Repositories\WordRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * @var WordRepository $wordRepo
     */
    protected $wordRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WordRepository $wordRepo)
    {
        $this->middleware('auth');
        $this->wordRepo = $wordRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $activities = ActivityLog::get($user);

        $followedIds = $user->followings()->pluck('id')->toArray();
        $followedActivities = ActivityLog::all($followedIds);

        $follows = $user->followings()->get();

        $words = $this->wordRepo->getLearnedWord($user);

        return view('application.home', [
            'activities' => $activities,
            'followedActivities' => $followedActivities,
            'follows' => $follows,
            'words' => $words,
        ]);
    }
}
