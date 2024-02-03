<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogFilterRequest;

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
        return view('blog.new',[
            'categories' => Categorie::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
        
    }

    public function create(BlogFilterRequest $request)
    {
        $article = Article::create($this->extractData($request, new Article()));
        $article->tags()->sync($request->validated('tags'));

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
        
        $article->tags()->sync($request->validated('tags'));
        $article->update($this->extractData($request, $article));
        return redirect()->route('blog.show', ['slug' => $article->slug, 'article' => $article->id])->with('success', 'Article modifié!');
    }

    private function extractData(BlogFilterRequest $request, Article $article): array
    {
        $data= $request->validated();
        
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        
        if($image==null || $image->getError()) {
            return $data;
        }
        if($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $data['image'] = $image->store('blog', 'public');
        return $data;
    }

}
