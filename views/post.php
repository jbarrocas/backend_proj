<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Pic</title>
</head>
<body>
    <main>
        <div class="create-post-container">
            <h1>Post a Pic</h1>
            <form method="POST" action="/post/" enctype=multipart/form-data>
                <input type="text" name="title" required>
                <input type="text" name="content" required>
                <input type="file" name="photo" id="photo" accept="<?= implode(",", $allowed_formats) ?>" required>
                <input type="submit" value="Post" name="send">
            </form>
        </div>
    </main>    
</body>
</html>