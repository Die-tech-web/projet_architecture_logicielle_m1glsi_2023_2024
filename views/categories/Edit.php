<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Ajouter / Modifier une catégorie</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" class="form-control" value="<?= isset($category) ? $category['nom'] : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php include 'views/layouts/footer.php'; ?>
