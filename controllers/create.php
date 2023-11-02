<?php

$allowed_formats = [
    "jpeg" => "image/jpeg",
    "png" => "image/png"
];

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    if( isset($_POST["send"]) ) {

        foreach($_POST as $key => $value) {
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }

        if(
            !empty($_POST["title"]) &&
            !empty($_POST["content"])
        ) {
            if(
                mb_strlen($_POST["title"]) >= 3 &&
                mb_strlen($_POST["title"]) <= 50 &&
                mb_strlen($_POST["content"]) >= 10 &&
                mb_strlen($_POST["content"]) <= 222
            ) {
                if(
                    in_array($_FILES["photo"]["type"], $allowed_formats)
                    ){
                        if(
                            $_FILES["photo"]["error"] === 0 &&
                            $_FILES["photo"]["size"] > 0 &&
                            $_FILES["photo"]["size"] <= 1 * 1024 * 1024
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
                            $message = "File size must be less than 1 MB";
                        }
                }
                else {
                    $message = "File type not supported";
                }

            }
            else {
                $message = "Respect min and max carachters";
            }
        }
        else {
            $message = "Fill in all the fields";
        }
    }
}

require("views/create.php");

?>