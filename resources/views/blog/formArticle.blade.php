<div class="container mt-4">
    <h2>Formulaire d'Enregistrement</h2>

    <form method="POST" class="vstack gap-2" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            {{-- importer des images --}}
            <label for="image">Image :</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Entrez l'image" @if(request()->route()->getName()=='blog.new') value='{{ old('image') }}' @else value='{{ $article->image }}' @endif>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre" @if(request()->route()->getName()=='blog.new') value='{{ old('title') }}' @else value='{{ $article->title }}' @endif>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug :</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Entrez le slug" @if(request()->route()->getName()=='blog.new') value='{{ old('slug') }}' @else value='{{ $article->slug }}' @endif>
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Entrez le contenu" >@if(request()->route()->getName()=='blog.new'){{ old('content') }} @else{{ $article->content }}@endif</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="categorie">Catégorie :</label>
            <select class="form-control" id="categorie_id" name="categorie_id">
                <option value="">Choisissez une catégorie</option>
                @foreach($categories as $categorie)
                    <option @if(request()->route()->getName()=='blog.modify') @selected(old('categorie_id', $article->categorie_id) == $categorie->id) @endif value="{{ $categorie->id }}" >{{ $categorie->name }}</option>
                @endforeach
            </select>
            @error('categorie')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @php
            if(request()->route()->getName()=='blog.modify'){
                $tagsIds = $article->tags->pluck('id');
            }
            
        @endphp

        <div class="form-group mb-3">
            <label for="tags">Tags :</label>
            <select class="form-control" id="tags" name="tags[]" multiple>
                @foreach($tags as $tag)
                    <option  @if(request()->route()->getName()=='blog.modify') @selected($tagsIds->contains($tag->id)) @endif value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @if (request()->route()->getName()=='blog.modify')
            <button type="submit" class="btn btn-primary">Modifier</button>
        @else
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        @endif
        
    </form>
</div>