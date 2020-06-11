<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
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
    public function show(Request $request)
    {
        $user = $request->user();

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
}
