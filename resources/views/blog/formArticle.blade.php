<div class="container mt-4">
    <h2>Formulaire d'Enregistrement</h2>

    <form method="POST">
        @csrf

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
            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Entrez le contenu" >@if(request()->route()->getName()=='blog.new') {{ old('content') }} @else {{ $article->content }} @endif</textarea>
            @error('content')
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