<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Blog extends Controller
{
    protected $article = null;

    //博客首页
    public function index()
    {
        $articles = Article::where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'DESC')
            ->paginate(config('blog.articles_per_page'));
        return view('blog.index', compact('articles'));
        return $articles;
    }

    //博客详情
    public function detail($slug, Request $request)
    {
        $slug = Input::get('slug');
        $articleModel = new Article();
        $article = $articleModel->where('slug', $slug)
            ->firstOrFail();
        return $article;
    }


}
