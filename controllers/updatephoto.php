<?php

require("models/users.php");

$allowed_formats = [
    "jpeg" => "image/jpeg",
    "png" => "image/png"
];

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    $model = new Users();
    $user = $model->getById($_SESSION["user_id"]);

    if( isset($_POST["send"]) ) {

        if(
            in_array($_FILES["photo"]["type"], $allowed_formats)
        ) {
            if(
                $_FILES["photo"]["error"] === 0 &&
                $_FILES["photo"]["size"] > 0 &&
                $_FILES["photo"]["size"] <= 2 * 1024 * 1024                
            ) {
    
                $file_extension = array_search($_FILES["photo"]["type"], $allowed_formats);
    
                $filename = $_SESSION["user_id"] . "_user_profile_photo." . $file_extension;
    
                move_uploaded_file($_FILES["photo"]["tmp_name"], "./images/users/" . $filename);
    
                $post["photo"] = $filename;
    
                $model->updatePhoto($post, $_SESSION["user_id"]);    
    
                header("Location: /myprofile/");
            }
            else {
                $message = "File size must be less than 2 MB";
            }
        }
        else {
            $message = "Image type is not supported";
        }
    }
}

require("views/updatephoto.php");

?>