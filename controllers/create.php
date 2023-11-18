<?php

$allowed_formats = [
    "jpg" => "image/jpeg"
];

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    if( isset($_POST["send"]) ) {

        require("models/users.php");
        $modelUsers = new Users();
        $user = $modelUsers->getById($_SESSION["user_id"]);
        
        $actualDate = strtotime(date("Y-m-d H:i:s"));
        $restrictedUntil = strtotime($user["restricted_until"]);
        $diff = $actualDate - $restrictedUntil;

        if( $diff < 0 ) {
            $message = "You are not able to create a post until " . $user["restricted_until"] . ". Check your email box for more details.";
            http_response_code(403);
        }
        else {

            foreach($_POST as $key => $value) {
                $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
            }
    
            if(
                empty($_POST["title"]) ||
                empty($_POST["content"])
            ) {
                $message = "Fill in all the fields";
            }
            else {
    
                if(
                    mb_strlen($_POST["title"]) < 3 ||
                    mb_strlen($_POST["title"]) > 50 ||
                    mb_strlen($_POST["content"]) < 10 ||
                    mb_strlen($_POST["content"]) > 222
                ) {
                    $message = "Respect min and max carachters";
                }
                else {
    
                    if(
                        $_FILES["photo"]["size"] === 0
                    ) {
                        $message = "File not selected";
                    }
                    else {
    
                        if(
                            !in_array($_FILES["photo"]["type"], $allowed_formats)
                        ) {
                            $message = "File type not supported";
                        }
                        else {
        
                            if(
                                $_FILES["photo"]["size"] > 2 * 1024 * 1024
                            ) {
                                $message = "File size must be less than 2 MB";
                            }
                            else {
                    
                                $file_extension = array_search($_FILES["photo"]["type"], $allowed_formats);
                    
                                $filename = date("YmdHis") . "_" . mt_rand(100000, 999999) . "." .$file_extension;
        
                                $image = $_FILES["photo"]["tmp_name"];
        
                                $image_save_path = "./images/posts/" . $filename;
        
                                require("functions/imageresize.php");
                                CroppedImage($image, 640, 640, $image_save_path);
        
                                $post = $_POST;
                                $post["filename"] = $filename;
                                $post["user_id"] = $_SESSION["user_id"];
                    
                                require("models/posts.php");
                    
                                $model = new Posts();
                                $post_id = $model->createPost($post);

                                http_response_code(202);
                    
                                header("Location: /postdetail/" . $post_id);
                            }
                        }
                    }                
                }
            }
        }
    }
}

require("views/create.php");

?>