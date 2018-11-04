<!DOCTYPE html>
  <html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="Public/css/materialize.css"  media="screen,projection"/>
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <header>
            <nav class="light-blue">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="index.php?page=home" class="title">Billet simple pour l'Alaska</a>
                    
                        <ul class="right hide-on-med-and-down">
                            <li ><a href="index.php?page=home">Accueil</a></li>
                            <li ><a href="index.php?page=chapters">Chapitres</a></li>
                        </ul>
                    
                    </div>
                </div>
            </nav>  
        </header>

    <?= $content ?>

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
        <script type="text/javascript" src="Public/js/materialize.js"></script>
        <script type="text/javascript" src="Public/js/script.js"></script>

        <!-- <>?php
            $pages_js = scandir('js/');
            if(in_array($page.'.func.js',$pages_js)){
                ?>
                    <script type="text/javascript" src="js/<>?= $page ?>.func.js"></script>
                <>?php
            }
        ?> -->

    </body>
</html>