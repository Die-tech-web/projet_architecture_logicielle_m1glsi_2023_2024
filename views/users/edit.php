<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Modifier un utilisateur</h2>
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control">
        </div>
        <div class="form-group">
            <label for="type">Type :</label>
            <select name="type" id="type" class="form-control">
                <option value="visiteur" <?= $user['type'] == 'visiteur' ? 'selected' : '' ?>>Visiteur</option>
                <option value="editeur" <?= $user['type'] == 'editeur' ? 'selected' : '' ?>>Éditeur</option>
                <option value="administrateur" <?= $user['type'] == 'administrateur' ? 'selected' : '' ?>>Administrateur</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
<?php include 'views/layouts/footer.php'; ?>
