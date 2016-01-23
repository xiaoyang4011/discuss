<?php
/**
 * Created by PhpStorm.
 * User: liuxiaoyang
 * Date: 15/11/14
 * Time: 上午10:14
 */

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->take(10)->get();

        return view('articles.index')->with('articles', $articles);
    }

    public function show($id){
        $article = Article::find($id);

        return view('articles.show')->with('article', $article);
    }

    public function add(){

        if(!(Auth::check())){
            return redirect('/');
        }
        return view('articles.add');
    }

    public function addHandle(Request $request){
        if(!(Auth::check())){
            return redirect('/');
        }
        $title = $request->get('title');
        $content = $request->get('content');

        if(!$title && !$content){
            return;
        }
        $article = [
            'title' => $title,
            'published_at' => Carbon::now()->toDateTimeString(),
            'content' => $content,
        ];

        Article::create($article);

        return redirect('/');
    }
}
