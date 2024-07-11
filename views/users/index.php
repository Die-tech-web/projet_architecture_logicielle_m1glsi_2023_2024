<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Liste des Utilisateurs</h2>
    <div class="users-list">
        <?php foreach ($users as $user): ?>
            <div class="user-item">
                <p><?= htmlspecialchars($user['nom']) ?> (<?= htmlspecialchars($user['email']) ?>)</p>
                <div class="user-actions">
                    <a href="index.php?controller=user&action=edit&id=<?= $user['id'] ?>" class="btn btn-modify">Modifier</a>
                    <a href="index.php?controller=user&action=delete&id=<?= $user['id'] ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php?controller=user&action=create" class="btn btn-add">Ajouter un utilisateur</a>
</div>
<?php include 'views/layouts/footer.php'; ?>
