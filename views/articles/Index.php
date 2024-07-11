<?php include 'views/layouts/header.php'; ?>

<div class="container">
    <h2>Articles</h2>

    <div class="articles-list">
        <?php foreach ($articles as $article): ?>
            <div class="article-card" data-article-id="<?= $article['id'] ?>">
                <h3><a href="index.php?controller=article&action=view&id=<?= $article['id'] ?>" class="article-link"><?= htmlspecialchars($article['titre']) ?></a></h3>
                <p class="article-category">Catégorie : <?= htmlspecialchars($article['nom_categorie']) ?></p>
                <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
                <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'administrateur' || $_SESSION['user_type'] === 'editeur')): ?>
                    <div class="article-actions">
                        <a href="index.php?controller=article&action=edit&id=<?= $article['id'] ?>" class="btn btn-modify">Modifier</a>
                        <a href="index.php?controller=article&action=delete&id=<?= $article['id'] ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?controller=article&action=index&page=<?= $page - 1 ?>" class="btn btn-primary">Précédent</a>
        <?php endif; ?>
        <?php if ($hasMorePages): ?>
            <a href="index.php?controller=article&action=index&page=<?= $page + 1 ?>" class="btn btn-primary">Suivant</a>
        <?php endif; ?>
    </div>
</div>

<script>
    document.querySelectorAll('.article-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const articleCard = this.closest('.article-card');
            articleCard.style.opacity = '0.5';
            articleCard.style.transition = 'opacity 0.5s';

            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
    });
</script>

<?php include 'views/layouts/footer.php'; ?>
