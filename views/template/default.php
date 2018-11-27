<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= $pageTitle; ?></title>
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="public/css/materialize.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="public/js/materialize.js"></script>
    <script type="text/javascript" src="public/js/responsive.js"></script>
  </head>
  <body>
    <nav class="light-blue">
        <div class="container">
            <div class="nav-wrapper">
              <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska de Jean Forteroche</a>  
                <ul class="right hide-on-med-and-down">
                  <li><a title="Administration" href="index.php?p=admin"><i class="material-icons">lock</i></a></li>
                </ul>
                <ul class="side-nav" id="mobile-menu">
                  <li><a title="Administration" href="index.php?p=admin"><i class="material-icons">lock</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

      <?= $content; ?>
      
    <footer>
        <p class="titleDetail">2018 - <a href="#" data-activates="mobile-menu" id="admin-btn" class="button-collapse">Jean Forteroche</a></p>
    </footer>
  </body>
</html>
