<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2><?= isset($article) ? 'Modifier l\'article' : 'Ajouter un article'; ?></h2>
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" class="form-control" value="<?= isset($article) ? htmlspecialchars($article['titre']) : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea name="contenu" id="contenu" class="form-control" required><?= isset($article) ? htmlspecialchars($article['contenu']) : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="id_categorie">Catégorie :</label>
            <select name="id_categorie" id="id_categorie" class="form-control">
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id'] ?>" <?= isset($article) && $article['id_categorie'] == $categorie['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categorie['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
<?php include 'views/layouts/footer.php'; ?>
