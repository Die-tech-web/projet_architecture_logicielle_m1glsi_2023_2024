<?php include 'views/layouts/header.php'; ?>

<div class="container">
    <h2><?php echo htmlspecialchars($article['titre']); ?></h2>
    <p>Catégorie : <?php echo htmlspecialchars($article['id_categorie']); ?></p>
    <p><?php echo nl2br(htmlspecialchars($article['contenu'])); ?></p>
</div>

<?php include 'views/layouts/footer.php'; ?>
