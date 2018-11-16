<!-- <>?php --
// ajout de l'upload d'image à la création de chapitre
// function post_img($tmp_name, $extension){
//     $db = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
//     $id = $db->lastInsertId();
//     $image = [
//         'id'    =>  $id,
//         'chapter_image' =>  $id.$extension
//     ];

//     $sql = "UPDATE posts SET chapter_image = :chapter_image WHERE id = :id";
//     $req = $db->prepare($sql);
//     $req->execute($image);
//     move_uploaded_file($tmp_name,"public/img/".$id.$extension);
//     header("Location:index.php?page=post&id=".$id);
// }