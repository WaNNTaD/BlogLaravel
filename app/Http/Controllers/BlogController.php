<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() : View
    {
        return view('blog.index', [
            'articles' => Article::with('tags', 'categorie')->paginate(5)
        ]);
    }

    public function show(string $slug, Article $article) : View | RedirectResponse
    {
        if($article->slug !== $slug) {
            return redirect()->route('blog.show', ['slug' => $article->slug, 'id' => $article->id]);
        }
        return view('blog.show', [
            'article' => $article
        ]);
    }

    public function new()
    {
        return view('blog.new');
    }

    public function create(BlogFilterRequest $request)
    {
        $article = Article::create($request->validated());

        return redirect()->route('blog.show', ['slug' => $article->slug, 'article' => $article->id])->with('success', 'Article créé!');
    }

    public function modify(string $slug, Article $article) : View | RedirectResponse
    {
        if($article->slug !== $slug) {
            return redirect()->route('blog.modify', ['slug' => $article->slug, 'article' => $article->id]);
        }
        return view('blog.modify', [
            'article' => $article,
            'categories' => Categorie::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function update(BlogFilterRequest $request, string $slug, Article $article) : RedirectResponse
    {
        if($article->slug !== $slug) {
            return redirect()->route('blog.modify', ['slug' => $article->slug, 'article' => $article->id]);
        }
        $article->categorie()->associate(Categorie::find($request->validated('categorie_id')));
        $article->tags()->sync($request->validated('tags'));
        $article->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $article->slug, 'article' => $article->id])->with('success', 'Article modifié!');
    }


}
