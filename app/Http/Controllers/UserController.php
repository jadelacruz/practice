<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $aUser = Auth::user();

        return view('prfile', compact('aUser'));
    }

    public function update_avatar(Request $aRequest)
    {
        dd($aRequest);
        if ($aRequest->hasFile('avatar') === true) {
            $aAvatar = $aRequest->file('avatar');
        }
    }
}
