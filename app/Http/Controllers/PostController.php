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
        'sPage'  => 'post',
        'sSub'   => '',
        'aAlert' => ['type' => '', 'msg' => '']
    );

    /**
     * Create new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->aInject['sSub'] = 'view';
        $this->aInject['aPost'] = array();
        if (Auth::user()->isAdmin() === true) {
            $this->aInject['aPost'] = Auth::user()->post()->orderBy('created_at', 'desc')->get();
        } else {
            $aRecipient = Auth::user()->recipient()->with('post')->orderBy('created_at', 'desc')->get();
            foreach($aRecipient as $aRow) {
                $this->aInject['aPost'][] = $aRow['post'];
            }
        }

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

        $oPost = Post::create([
            'user_id'     => Auth::user()->id,
            'title'       => $aRequest['title'],
            'description' => $aRequest['description']
        ]);

        foreach ($aSeq as $sUserId) {
            Recipient::create([
                'post_id' => $oPost->id,
                'user_id' => (int)$sUserId
            ]);
        }

        $this->aInject['sSub'] = 'create';
        $this->aInject['aRecipient'] = User::where('id', '!=', Auth::user()->id)->get();
        $this->aInject['aAlert'] = ['type' => 'success', 'msg' => 'Success adding new data!'];
        return view('post.create', $this->aInject);
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
        $this->aInject['sSub'] = 'create';
        $this->aInject['aRecipient'] = User::where('id', '!=', Auth::user()->id)->get();
        $this->aInject['oPost'] = $post;
        return view('post.edit', $this->aInject);
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

    public function validator($aData)
    {
        return Validator::make($aData,
            array(
                'title'       => 'required|unique:posts',
                'description' => 'required',
                'seq'         => 'required'
            )
        );
    }
}
