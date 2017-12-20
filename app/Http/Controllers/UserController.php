<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $aInject = array(
        'sPage' => 'profile',
        'sSub' => ''
    );

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $this->aInject['aUser'] = Auth::user();
        $this->aInject['aRecipient'] = Auth::user()->recipient();
        return view('profile', $this->aInject);
    }

    public function update_avatar(Request $aRequest)
    {
        if ($aRequest->hasFile('avatar') === true) {
            $aAvatar = $aRequest->file('avatar');
        }
    }
}
