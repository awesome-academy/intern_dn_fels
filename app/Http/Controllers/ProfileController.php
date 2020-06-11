<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

        var_dump($data);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->address = $data['address'];
        $user->gender = $data['gender'];

        if (!empty($data['password'])) { }

        $user->save();

        return redirect()->route('profile.show');
    }
}
