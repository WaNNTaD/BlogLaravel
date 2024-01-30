<div class="container mt-4">
    <h2>Formulaire d'Enregistrement</h2>

    <form method="POST">
        @csrf

        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre" required>
        </div>

        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Entrez le contenu" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>