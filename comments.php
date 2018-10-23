<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Un billet pour l'Alaska</title>
    </head>
        
    <body>
        <h1>Un billet pour l'Alaska - Les commentaires</h1>
        <p><a href="index.php">Retour à la liste des chapitres</a></p>
 
<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération du post
$req = $bdd->prepare('SELECT  id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, author FROM posts ORDER BY id WHERE id = ?');
$req->execute(array($_GET['post']));
$data = $req->fetch();
?>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($data['title']); ?>
        <em>le <?php echo $data['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($data['content']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT id, comment, DATE_FORMAT(dateComment, \'%d/%m/%Y à %Hh%imin\') AS date_commentaire_fr FROM comments WHERE id_post = ? ORDER BY dateComment');
$req->execute(array($_GET['post']));

while ($data = $req->fetch()) {
    ?>
<p>Le <?php echo $data['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($data['commment'])); ?></p>
<?php

} // Fin de la boucle des commentaires
$req->closeCursor();
?>
</body>
</html>