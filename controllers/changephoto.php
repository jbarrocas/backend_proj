<?php

$allowed_formats = [
    "jpeg" => "image/jpeg",
    "png" => "image/png"
];

if( isset($_POST["send"]) ) {
        
    if(
        $_FILES["photo"]["error"] === 0 &&
        $_FILES["photo"]["size"] > 0 &&
        $_FILES["photo"]["size"] <= 1 * 1024 * 1024 &&
        in_array($_FILES["photo"]["type"], $allowed_formats)
    ) {

        $file_extension = array_search($_FILES["photo"]["type"], $allowed_formats);

        $filename = "user_" .  $_SESSION["user_id"] . "_photo" . "." .$file_extension;

        move_uploaded_file($_FILES["photo"]["tmp_name"], "./images/users/" . $filename);
        
        $_FILES["photo"] = $filename;

        require("models/users.php");

        $model = new Users();
        $user = $model->updatePhoto($_POST, $_SESSION["user_id"]);

        header("Location: /myprofile/");
    }
    else {
        $message = "Fill in all the fields";
    }
}

require("views/changephoto.php");

?>