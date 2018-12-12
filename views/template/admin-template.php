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
    <!-- <nav class="light-blue">
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
    <br /> -->
    <div class="center">
        <ul class="flex-container">
            <li class="tab" <?php if($selectedTab == 'dashboard') echo 'class="active"' ?>>
                <a title="Tableau de bord" href="index.php?p=admin&tab=dashboard"><i class="material-icons">dashboard</i></a>
                <p>Tableau de bord</p>
            </li>
            <li class="tab" <?php if($selectedTab == 'list') echo 'class="active"' ?>>
                <a title="Mes chapitres" href="index.php?p=admin&tab=list"><i class="material-icons">view_list</i></a>
                <p>Mes Chapitres</p>
            </li>
            <li class="tab" <?php if($selectedTab == 'write')  echo 'class="active"' ?>>
                <a title="Ecrire" href="index.php?p=admin&tab=write"><i class="material-icons">edit</i></a>
                <p>Ecrire</p>
            </li>
            <li class="tab" <?php if($selectedTab == 'comments') echo 'class="active"' ?>>
                <a title="Commentaires" href="index.php?p=admin&tab=comments"><i class="material-icons">comment</i></a>
                <p>Les Commentaires</p>
            </li>
        </ul>
    </div>

      <?= $content; ?>
      
    <footer>
        <p class="titleDetail">2018 - <a href="#" data-activates="mobile-menu" id="admin-btn" class="button-collapse">Jean Forteroche</a></p>
    </footer>
  </body>
</html>
