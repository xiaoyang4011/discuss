<?php

namespace App\Http\Controllers;

use App\Markdown\Markdown;
use EndaEditor;
use App\Models\Discussion;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{
    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth', ['only'=>['create', 'store', 'edit', 'update']]);
        $this->markdown = $markdown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::latest()->paginate(10);

        return view('forum.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::lists('name', 'id');

        return view('forum.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreBlogPostRequest $request)
    {
        $create_data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => \Auth::user()->id,
            'last_user_id' => \Auth::user()->id,
        ];

        $discussion = Discussion::create($create_data);


        return redirect()->action('DiscussionController@show', ['id'=>$discussion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $html = $this->markdown->markdown($discussion->body);

        return view('forum.show', compact('discussion','html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);

        if(\Auth::user()->id !== $discussion->user_id){
            return redirect('/');
        }
        return view('forum.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\StoreBlogPostRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);

        $discussion->update($request->all());

        return redirect()->action('DiscussionController@show', ['id'=>$discussion->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(){
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }
}
