<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Photo</title>
</head>
<body>
    <main>
        <h1>Change your profile photo</h1>
        <img src="<?=$user["photo"]?>" alt="">
        <form method="POST" action="/changephoto/" enctype=multipart/form-data>
            <input type="file" name="photo" id="newProfilePhoto" accept="<?= implode(",", $allowed_formats) ?>" required></input>
            <button type="submit" name="send">Send</button>
        </form>
    </main>    
</body>
</html>