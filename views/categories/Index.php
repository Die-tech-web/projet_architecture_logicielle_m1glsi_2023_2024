<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Catégories</h2>
    <a href="index.php?controller=category&action=create" class="btn btn-add">Ajouter une catégorie</a>
    <div class="categories-list">
        <?php foreach ($categories as $category): ?>
            <div class="category-item">
                <p><?= htmlspecialchars($category['nom']) ?></p>
                <div class="category-actions">
                    <a href="index.php?controller=category&action=edit&id=<?= $category['id'] ?>" class="btn btn-modify">Modifier</a>
                    <a href="index.php?controller=category&action=delete&id=<?= $category['id'] ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'views/layouts/footer.php'; ?>
