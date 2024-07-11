<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Connexion</h2>
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <?php if (isset($error)): ?>
            <p class="text-danger"><?= $error ?></p>
        <?php endif; ?>
    </form>
</div>
<?php include 'views/layouts/footer.php'; ?>
