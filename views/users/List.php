<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Liste des Utilisateurs</title>
</head>
<body>
    <header>
        <h1>SITE D'ACTUALITE</h1>
        <nav class="navigation">
            <div class="nav-left">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?controller=article&action=index">Articles</a></li>
                    <li><a href="index.php?controller=categorie&action=index">Catégories</a></li>
                    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'administrateur'): ?>
                        <li><a href="index.php?controller=user&action=listUsers">Liste des Utilisateurs</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="nav-right">
                <?php if (isset($_SESSION['id_utilisateur'])): ?>
                    <ul>
                        <li><a href="index.php?controller=user&action=profile&id=<?= $_SESSION['id_utilisateur'] ?>">Profil</a></li>
                        <li><a href="index.php?controller=user&action=logout">Déconnexion</a></li>
                    </ul>
                <?php else: ?>
                    <ul>
                        <li><a href="index.php?controller=user&action=login">Connexion</a></li>
                        <li><a href="index.php?controller=user&action=register">Inscription</a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2>Liste des Utilisateurs</h2>
        <div class="users-list">
            <?php foreach ($users as $user): ?>
                <div class="user-item">
                    <div class="user-info">
                        <p><?= htmlspecialchars($user['prenom']) . ' ' . htmlspecialchars($user['nom']) ?> (<?= htmlspecialchars($user['email']) ?>)</p>
                    </div>
                    <div class="user-actions">
                        <a href="index.php?controller=user&action=editUser&id=<?= $user['id'] ?>" class="btn btn-modify">Modifier</a>
                        <a href="index.php?controller=user&action=deleteUser&id=<?= $user['id'] ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="index.php?controller=user&action=createUser" class="btn btn-add">Ajouter un utilisateur</a>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Site de News. Tous droits réservés.</p>
    </footer>
</body>
</html>
