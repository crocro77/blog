<!-- <>?php $editComment = edit_comment($comment_edited,$id); ?> -->
<h2>Tableau de bord</h2>
<div class="row">

    <?php

        $tables = [
            "Publication(s)"      =>  "posts",
            "Commentaire(s)"      =>  "comments",
            "Administrateur(s)"   =>  "admins"
        ];

        $colors = [
            "posts"     =>  "orange",
            "comments"  =>  "green",
            "admins"    =>  "red"
        ];

    ?>


    <?php

        foreach($tables as $table_name => $table){
            ?>
                <div class="col l4 m6 s12">
                    <div class="card">
                        <div class="card-content <?= getColor($table,$colors) ?> white-text">
                            <span class="card-title"><?= $table_name ?></span>
                            <?php $nbrInTable = inTable($table); ?>
                            <h4><?= $nbrInTable[0] ?></h4>
                        </div>
                    </div>
                </div>
            <?php
        }

    ?>
</div>

<h4>Commentaire(s) non lu(s)</h4>

<?php

    $comments = get_comments();

?>

<table>
    <thead>
        <tr>
            <th>Chapitre</th>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($comments)) {
            foreach ($comments as $comment) {
                ?>
                <tr id="commentaire_<?= $comment->id ?>">
                    <td><?= $comment->title ?></td>
                    <td><?= substr($comment->comment, 0, 100); ?>...</td>
                    <td>
                        <a href="#" id="<?= $comment->id ?>" class="btn-floating btn-small waves-effect waves-light green see_comment"><i class="material-icons">done</i></a>
                        <a href="#" id="<?= $comment->id ?>" class="btn-floating btn-small waves-effect waves-light red delete_comment"><i class="material-icons">delete</i></a>
                        <a href="#comment_<?= $comment->id ?>" class="btn-floating btn-small waves-effect waves-light blue modal-trigger"><i class="material-icons">edit</i></a>

                            <div class="modal" id="comment_<?= $comment->id ?>">
                                <div class="modal-content">
                                    <h4><?= $comment->title ?></h4>

                                    <p>Commentaire posté par
                                        <strong><?= $comment->author . " (" . $comment->email . ")</strong><br/>Le " . date("d/m/Y à H:i", strtotime($comment->comment_date)) ?>
                                    </p>
                                    <hr/>
                                    <div class="input-field col s12"> 
                                        <textarea id="content" name="content" class="materialize-textarea"><?= $editComment->comment ?></textarea>
                                        <label for="content">Contenu de l'article</label>
                                    </div>
                                    <!-- <p><>?= nl2br($comment->comment) ?></p> -->
                                </div>

                                <div class="modal-footer">
                                    <a href="#" id="<?= $comment->id ?>"
                                    class="modal-action modal-close waves-effect waves-red btn-flat delete_comment"><i
                                            class="material-icons">delete</i></a>
                                    <a href="#" id="<?= $comment->id ?>"
                                    class="modal-action modal-close waves-effect waves-green btn-flat see_comment"><i
                                            class="material-icons">done</i></a>
                                </div>
                        </div>
                    </td>
                </tr>

            <?php
            }
        } else {
            ?>
                <tr>
                    <td></td>
                    <td><center>Aucun commentaire à valider</center></td>
                </tr>
            <?php
        }
        ?>
    </tbody>
</table>