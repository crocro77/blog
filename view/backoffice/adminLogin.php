<!-- A FAIRE -->

<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div id="adminLogin">
    <h2>Veuillez vous connecter</h2>
        <form action="index.php?action=" method="get">
            <div>
                <label for="login">Login</label><br />
                <input type="text" name="author">
            </div>
            <div>
                <label for="password">Password</label><br />
                <input type="password" name="password">
            </div>
            <div>
                <input id="button" type="submit">
            </div>
        </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>