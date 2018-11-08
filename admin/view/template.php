<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="public/css/materialize.css"  media="screen,projection"/>
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="public/js/materialize.js"></script>
        <script type="text/javascript" src="public/js/dashboard.js"></script>
    </head>

    <body>
    <nav class="light-blue">
        <div class="container">
            <div class="nav-wrapper">
                <a href="../index.php" class="title">Billet simple pour l'Alaska</a>
                <em>Espace d'administration</em>        
                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php?page=dashboard"><i class="material-icons">dashboard</i></a></li>
                    <li><a href="index.php?page=write"><i class="material-icons">edit</i></a></li>
                    <li><a href="index.php?page=list"><i class="material-icons">view_list</i></a></li>

                    <li><a href="../index.php">Quitter</a></li>
                    <li><a href="index.php?page=logout">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $content ?>

    </body>
</html>