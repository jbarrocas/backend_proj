<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>User Details - <?= $user["username"] ?></title>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["is_admin"]) || isset($_SESSION["is_super_admin"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <div class="page-content">
            <h1 class="heading-1">Update Your Details</h1>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>
            <form class="form" class="details-form" method="POST" action="/updatedetails/">
                <div>
                    <input class="form-input" type="text" name="first_name" placeholder="First Name" value="<?= $user["first_name"] ?>" required minlength="3" maxlength="22">
                </div>
                <div>
                    <input class="form-input" type="text" name="last_name" placeholder="Last Name" value="<?= $user["last_name"] ?>" required minlength="2" maxlength="22">
                </div>
                <div>
                    <input class="form-input" type="email" name="email" placeholder="Email" value="<?= $user["email"] ?>" required>
                </div>
                <div>
                    <select class="form-input" name="country_id" required>
<?php
    foreach($countries as $country) {
        $userCountry = $user["country_id"];
        $selected = $country["country_id"] === "$userCountry" ? "selected" : "";

        echo '
            <option value="' .$country["country_id"]. '"' .$selected. '>' .$country["name"]. '</option>
        ';
    }
?>
                    </select>
                </div>
                <div>
                    <button class="form-button" type="submit" name="send">Update Details</button>
                </div>
            </form>
            <a href="/updatepassword/"><div class="form-whiteButton">Update Password</div></a>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>