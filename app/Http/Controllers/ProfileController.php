<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function index()
    {
        return view('users.profile');
    }

    public function update(Request $request)
    {
        $user = User::whereId(auth()->user()->id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
        ]);

        return Redirect::back()->with([
            'message' => 'Profile Updated Successfully!',
            'user' => $user,
        ]);
    }
}
