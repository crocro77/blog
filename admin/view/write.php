<?php $title = "Billet simple pour l'Alaska | Administration"; ?>

<?php ob_start(); ?>

<h2>Poster un article</h2>

<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title"/>
            <label for="title">Titre</label>
        </div>

        <div class="input-field col s12">
            <textarea name="content" id="content" class="materialize-textarea"></textarea>
            <label for="content">Contenu</label>
        </div>
        <div class="col s12">
            <div class="btn light-blue waves-effect waves-light input-field file-field col s3">
                <span>Image de l'article</span>
                <input type="file" name="image" class="col s12"/>
            </div>
        </div>

        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public"/>
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>

        <div class="col s6 right-align">
            <br/><br/>
            <button class="btn light-blue waves-effect waves-light" type="submit" name="post">Publier</button>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>