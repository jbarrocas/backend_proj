<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["admin_id"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <h1>Create Admin and User</h1>
        <div class="create-admin-container">
            <div class="form-container">
                <form class="create-admin-form" method="POST" action="/admin_createadmin/">
                    <input class="create-input" type="text" name="first_name" placeholder="First Name" value="<?= $first_name ?>" required minlength="3" maxlength="22">
                    <input class="create-input" type="text" name="last_name" placeholder="Last Name" value="<?= $last_name ?>" required minlength="2" maxlength="22">
                    <input class="create-input" type="text" name="username" placeholder="Username" value="<?= $username ?>" required minlength="3" maxlength="33">
                    <input class="create-input" type="email" name="email" placeholder="Email" value="<?= $email ?>" required>
                    <input class="create-input" type="password" name="password" placeholder="Password" value="<?= $password ?>" required minlength="8" maxlength="1000">
                    <input class="create-input" type="password" name="password_confirm" placeholder="Password Confirm" value="<?= $password_confirm ?>" required minlength="8" maxlength="1000">
                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                    <select class="create-select" name="country_id" required>
<?php
    foreach($countries as $country) {
        $selected = $country["country_id"] === "US" ? " selected" : "";

        echo '
            <option value="' .$country["country_id"]. '"' .$selected. '>' .$country["name"]. '</option>
        ';
    }
?>
                    </select>
                    <input class="create-input" type="text" name="super_admin" placeholder="Super_admin?" required>
                    <button class="create-admin-button" type="submit" name="send">Create Admin</button>
                </form>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
            </div>