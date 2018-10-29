<?php

require_once("model/PostManager.php");
require_once("model/CommentManager.php");

use \Anthony\Blog_Alaska\Model\PostManager;
use \Anthony\Blog_Alaska\Model\CommentManager;

// Edition du commentaire -- A FAIRE
// function editComment($newComment, $commentID, $postID)
// {
//     $commentManager = new CommentManager();
   
//     $affectedComment = $commentManager->editComment($newComment,$commentID);
   
//     require('view/frontend/commentView.php');
   
//     if ($affectedComment == false){
//         throw new Exception('Impossible d\'editer le commentaire !');
//     }
//     else {
//         header('Location : index.php?action=post&id=' .$postID);
//     }
// }
// Suppression du commentaire -- A FAIRE
// function deletePost()
// {

// }
// Création d'un nouveau post -- A FAIRE
// function createPost()
// {

// }