<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;
use App\Recipient;

class PostController extends Controller
{
    /**
     * @var array
     */
    private $aInject = array(
        'sPage' => 'post',
        'sSub' => '',
    );

    /**
     * Create new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->aInject['sSub'] = 'view';
        $this->aInject['aPost'] = Auth::user()->post;
        return view('post.view', $this->aInject);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->aInject['sSub'] = 'create';
        $this->aInject['aRecipient'] = User::where('id', '!=', Auth::user()->id)->get();
        return view('post.create', $this->aInject);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return object
     */
    public function store(Request $request)
    {
        $aRequest = $request->all();
        $this->validator($aRequest)->validate();
        $aSeq = explode(',', $aRequest['seq']);
        $oPost = new Post;
        $oPost->user_id = Auth::user()->id;
        $oPost->title = $aRequest['title'];
        $oPost->description = $aRequest['description'];
        $oPost->save();

        foreach ($aSeq as $sUserId) {
            $aRecipient['post_id'] = $oPost->id;
            $aRecipient['user_id'] = (int)$sUserId;
            Recipient::create($aRecipient);
        }

        return redirect()->route('post.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return object
     */
    public function show(Post $post)
    {
        return $post;
    }

    public function getRecipientByPostId($iId)
    {
        return Post::with('recipient')->find($iId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return object
     */
    public function edit(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return object
     */
    public function update(Request $request, Post $post)
    {
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return boolean
     */
    public function destroy(Post $post)
    {
        $post->recipient()->delete();
        return json_encode($post->delete());
    }

    public function validator($aData) {
        return Validator::make($aData, array(
            'title' => 'required|unique:posts',
            'description' => 'required',
            'seq' => 'required'
        ));
    }
}
