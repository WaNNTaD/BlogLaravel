<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(25);
        return view('blog.index', [
            'articles' => $articles
        ]);
    }

    public function new()
    {
        return view('blog.new');
    }

    public function create(Request $request)
    {
        
        $article = Article::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('blog.show', ['slug' => $article->slug, 'id' => $article->id]);
    }

    public function show(string $slug, string $id) : View | Article
    {
        $article = Article::findOrFail($id);
        if($article->slug !== $slug) {
            return redirect()->route('blog.show', ['slug' => $article->slug, 'id' => $article->id]);
        }
        return view('blog.show', [
            'post' => $article
        ]);
    }
}
