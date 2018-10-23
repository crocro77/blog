<!DOCTYPE html>
<html>
  <head>
    <title>Billet simple pour l'Alaska</title>    
    <meta charset="utf-8" />
    <link href="style.css" rel="stylesheet" /> 
  </head>
  <body>
    <div id="illustration">
        <img id="landscape" src="img/alaska_landscape.jpg" alt="alaska landscape">
    </div>
    <div id="title">
    <h1>Billet simple pour l'Alaska de Jean Forteroche</h1>
    </div>
    <div id="posts">
    <?php
        // Connexion à la base de données
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        // On récupère les derniers posts
        $req = $bdd->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, author FROM posts ORDER BY id');
        
        while ($data = $req->fetch())
        {
            echo "<h2>{$data['title']}</h2>";
            echo "<p>{$data['content']}</p>";
            echo "<p>Le {$data['date_creation_fr']} par {$data['author']}</p>";
        }
        // Fin de la boucle sur les posts
        $req->closeCursor();
    ?>
    </div>
  </body>
</html>