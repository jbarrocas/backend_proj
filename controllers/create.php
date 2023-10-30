<?php

var_dump($_SESSION);

$allowed_formats = [
    "jpeg" => "image/jpeg",
    "png" => "image/png"
];

if( isset($_POST["send"]) ) {

    foreach($_POST as $key => $value) {
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    if(
        $_FILES["photo"]["size"] > 2 * 1024 * 1024
    ) {

        $message = "The image cannot be bigger than 2 MB";

    }
    else {
        
        if(
            !empty($_POST["title"]) &&
            !empty($_POST["content"]) &&
            mb_strlen($_POST["title"]) >= 3 &&
            mb_strlen($_POST["title"]) <= 50 &&
            mb_strlen($_POST["content"]) >= 10 &&
            mb_strlen($_POST["content"]) <= 255 &&
            $_FILES["photo"]["error"] === 0 &&
            $_FILES["photo"]["size"] > 0 &&
            $_FILES["photo"]["size"] <= 2 * 1024 * 1024 &&
            in_array($_FILES["photo"]["type"], $allowed_formats)
        ) {
    
            $file_extension = array_search($_FILES["photo"]["type"], $allowed_formats);
    
            $filename = date("YmdHis") . "_" . mt_rand(100000, 999999) . "." .$file_extension;
    
            move_uploaded_file($_FILES["photo"]["tmp_name"], "./images/posts/" . $filename);
            
            $_FILES["photo"] = $filename;
    
            require("models/posts.php");
    
            $model = new Posts();
            $user = $model->createPost($_POST);    
    
            header("Location: /postdetail/" . $_SESSION["post_id"]);
        }
        else {
            $message = "Fill in all the fields";
        }
    }
}

require("views/create.php");

?>