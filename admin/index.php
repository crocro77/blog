<?php

require("controller/BackController.php");

$pages = scandir('view/');
if(isset($_GET['view']) && !empty($_GET['view'])){
    if(in_array($_GET['view'].'.php',$pages)){
        $page = $_GET['view'];
    }else{
        $page = "error";
    }
}else{
    $page = "dashboard";
}

$pages_functions = scandir('model/');
if(in_array($page.'.func.php',$pages_functions)){
    include 'model/'.$page.'.func.php';
}

if(isset($_POST['submit'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];

    if(empty($email) || empty($password)){
        $errors['empty'] = "Tous les champs n'ont pas été remplis!";
        } else if (is_admin($email,$password) == 0){
        $errors['exist']  = "Cet administrateur n'existe pas";
    }

    if(!empty($errors)){
        ?>
        <div class="card red">
            <div class="card-content white-text">
                <?php
                    foreach($errors as $error){
                    echo $error."<br/>";
                    }
                ?>
            </div>
        </div>
        <?php
    } else {
        $_SESSION['admin'] = $email;
        header("Location:index.php?page=dashboard");
    }

}

if(isset($_POST['post'])){
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $posted = isset($_POST['public']) ? "1" : "0";

    $errors = [];

    if(empty($title) || empty($content)){
        $errors['empty'] = "Veuillez remplir tous les champs";
    }

    if(!empty($_FILES['image']['name'])){
        $file = $_FILES['image']['name'];
        $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
        $extension = strrchr($file,'.');

        if(!in_array($extension,$extensions)){
            $errors['image'] = "Cette image n'est pas valable";
        }
    }

    if(!empty($errors)){
        ?>
            <div class="card red">
                <div class="card-content white-text">
                    <?php
                        foreach($errors as $error){
                            echo $error."<br/>";
                        }
                    ?>
                </div>
            </div>
        <?php
    }else{
        post($title,$content,$posted);
        if(!empty($_FILES['image']['name'])){
            post_img($_FILES['image']['tmp_name'], $extension);
        }else{
            $id = $db->lastInsertId();
            header("Location:index.php?page=post&id=".$id);
        }
    }
}


?>