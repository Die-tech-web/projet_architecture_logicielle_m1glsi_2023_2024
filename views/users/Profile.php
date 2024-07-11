<?php include 'views/layouts/header.php'; ?>
<div class="container">
    <h2>Profil de <?= $user['nom'] ?></h2>
    <p>Email : <?= $user['email'] ?></p>
    <p>Type : <?= $user['type'] ?></p>
</div>
