<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="public/css/materialize.css"  media="screen,projection"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="public/js/materialize.js"></script>
        <script type="text/javascript" src="public/vendor/tiny_mce/tiny_mce.js"></script>
        <script src="public/vendor/js/tiny_mce_script.js"></script>
    </head>
        
    <body>
        <nav class="light-blue">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="../index.php?page=home" class="title">Billet simple pour l'Alaska</a>
                
                    <ul class="right hide-on-med-and-down">
                        <li class="<?php echo ($page=="dashboard")?"active" : ""; ?>"><a href="index.php?page=dashboard"><i class="material-icons">dashboard</i></a></li>
                        <li class="<?php echo ($page=="write")?"active" : ""; ?>"><a href="index.php?page=write"><i class="material-icons">edit</i></a></li>
                        <li class="<?php echo ($page=="list")?"active" : ""; ?>"><a href="index.php?page=list"><i class="material-icons">view_list</i></a></li>

                        <li><a href="../index.php?page=home">Quitter</a></li>
                        <li><a href="index.php?page=logout">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <?= $content ?>
    </body>

    <footer>
        <p id="titleDetail">2018 - Jean Forteroche</p>
    </footer>
</html>