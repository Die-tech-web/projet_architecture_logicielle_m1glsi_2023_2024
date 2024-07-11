<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Inscription</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nom">Prenom :</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
        <?php if (isset($error)): ?>
            <p class="text-danger"><?= $error ?></p>
        <?php endif; ?>
    </form>
</div>
