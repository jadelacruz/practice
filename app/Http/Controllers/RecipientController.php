<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Recipient;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Recipient::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $recipient
     * @return Recipient
     */
    public function show(Recipient $recipient)
    {
        return $recipient;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipient $recipient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipient $recipient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipient $recipient)
    {
        //
    }

    public function getUserNotViewedNotification()
    {
        $oNotif = Auth::user()->recipient()->with('post')->notViewed()->orderBy('created_at', 'desc')->take(5)->get();
        foreach ($oNotif as $oRow) {
            $oRow->notified_at = date('Y-m-d');
            $oRow->save();
        }
        return $oNotif;
    }

    public function getUserNewNotification()
    {
        $oNotif = Auth::user()->recipient()->with('post')->notNotified()->orderBy('created_at')->get();
        foreach($oNotif as $oRow) {
            $oRow->notified_at = date('Y-m-d');
            $oRow->save();
        }
        return $oNotif;
    }

    public function viewed(Recipient $recipient)
    {
        $recipient->viewed_at = date('Y-m-d');
        $mResult = $recipient->save();
        return (string)$mResult;
    }

    public function received(Recipient $recipient)
    {
        $recipient->received_at = date('Y-m-d');
        $mResult = $recipient->save();
        return (string)$mResult;
    }

    public function confirmed(Recipient $recipient)
    {
        $recipient->confirmed_at = date('Y-m-d');
        $mResult = $recipient->save();
        return (string)$mResult;
    }

    public function forwarded(Recipient $recipient)
    {
        $recipient->forwarded_at = date('Y-m-d');
        $mResult = $recipient->save();
        return (string)$mResult;
    }
}
