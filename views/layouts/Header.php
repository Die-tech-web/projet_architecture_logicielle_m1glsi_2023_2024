<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Site de News</title>
    <style>
        header .navigation li a {
            background-color: transparent !important;
        }
        header .navigation li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>SITE D'ACTUALITE</h1>
        <nav class="navigation">
            <div class="nav-left">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?controller=article&action=index">Articles</a></li>
                    <li><a href="index.php?controller=category&action=index">Catégories</a></li>
                    <?php if (isset($_SESSION['user_type']) && in_array($_SESSION['user_type'], ['editeur', 'administrateur'])): ?>
                        <li><a href="index.php?controller=article&action=create">Ajouter un Article</a></li>
                        <li><a href="index.php?controller=category&action=create">Ajouter une Catégorie</a></li>
                    <?php endif; ?>
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
    </div>
</body>
</html>
