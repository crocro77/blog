<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= $pageTitle; ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="public/css/materialize.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="public/js/materialize.js"></script>
  </head>

  <body>
    <nav class="light-blue">
        <div class="container">
            <div class="nav-wrapper">
              <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska de Jean Forteroche</a>       
                <ul class="right hide-on-med-and-down">
                    <li><a title="Administration" href="index.php?p=admin"><i class="material-icons">lock</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <?php
      echo $content;
    ?>

    <footer>
        <p id="titleDetail">2018 - Jean Forteroche</p>
    </footer>
    
    <?php 
    // on utilise TinyMCE sur adminmenu write et edit.
    if(isset($_GET['p']) && $_GET['p'] === 'admin' && isset($_GET['menu']) && $_GET['menu'] == 'write' || isset($_GET['menu']) && $_GET['menu'] == 'edit')
    {
      ?>
      <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
      <script>tinymce.init({
              selector: 'textarea',
              height: 800,
              menubar: false,
              plugins: [
                'advlist autolink lists charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media save table contextmenu paste code'
              ],
              toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
              content_css: '//www.tinymce.com/css/codepen.min.css'
            });</script>
      <?php
    }
    ?>
  </body>
</html>
