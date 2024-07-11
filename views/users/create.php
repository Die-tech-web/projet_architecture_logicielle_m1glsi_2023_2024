<?php include 'views/layouts/header.php'; ?>
<div class="container form-container">
    <form method="post" class="form">
        <h2>Ajouter un utilisateur</h2>
        <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type">
            <option value="visiteur">Visiteur</option>
            <option value="editeur">Éditeur</option>
            <option value="administrateur">Administrateur</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<?php include 'views/layouts/footer.php'; ?>
