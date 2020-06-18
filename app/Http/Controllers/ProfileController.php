<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Helpers\ActivityLog;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\FollowRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show profile page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        if (is_null($id)) {
            $user = $request->user();
        } else {
            $user = User::find($id);

            if (is_null($user)) {
                abort(404);
            }
        }

        return view('application.profile.index', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        return view('application.profile.edit', [
            'user' => $user,
        ]);
    }


    /**
     * Update user profile
     */
    public function update(EditProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $data = $request->all();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->address = $data['address'];
        $user->gender = $data['gender'];

        // change password
        if (!empty($data['password'])) {
            if (Hash::check($data['current_password'], $user->password)) {
                $user->password = $data['password'];
            } else {
                return redirect()->back()->withErrors([
                    trans('messages.wrongPassword'),
                ]);
            }
        }

        // change profile image
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = $request->file('avatar')->store('');
            $user->avatar_url = '/storage/' . $path;
        }

        $user->save();

        return redirect()->route('profile.show');
    }

    /**
     * Make the user follow another user
     */
    public function follow(FollowRequest $request)
    {
        $id = $request->get('id');

        /**
         * @var User $target
         */
        $target = User::find($id);

        if (is_null($target)) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        /**
         * @var User $user
         */
        $user = $request->user();

        $result = $user->followings()->toggle($id);

        $isAttach = count($result['attached']) > 0;
        $label = $isAttach ? trans('labels.profilePage.unfollow') : trans('labels.profilePage.follow');

        if ($isAttach) {
            ActivityLog::add(ActivityType::FollowUser, $target->name);
        } else {
            ActivityLog::add(ActivityType::UnfollowUser, $target->name);
        }

        return response()->json([
            'message' => 'Success',
            'followed' => $isAttach,
            'label' => $label,
        ]);
    }
}
