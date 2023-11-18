<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Status - <?= $admin["username"] ?></title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Update Admin Status</h1>
        <div class="update-admin-container">
            <div>
                <figure>
                    <img src="../images/users/<?= $admin["photo"] ?>" alt="">
                </figure>
                <p>Username: <?= $admin["username"] ?></p>
                <p>First Name: <?= $admin["first_name"] ?></p>
                <p>Last Name: <?= $admin["last_name"] ?></p>
                <p>Country: <?= $admin["country"] ?></p>
                <p>Member Since: <?= $admin["created_at"] ?></p>
                <p>Admin Status = <?= $admin["is_admin"] ?></p>
                <p>Super Admin Status = <?= $admin["is_super_admin"] ?></p>
                <p>Admin Status Updated at: <?= $admin["admin_status_updated_at"] ?></p>
            </div>
            <h2>Change Status</h2>
            <form class="update-admin-form" method="POST" action="/admin_updateadminstatus/<?= $admin["user_id"] ?>">
                <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                <select class="update-admin-select" name="is_admin" required>
<?php
    foreach($selectOptions as $selectOption) {
        $isAdmin = $admin["is_admin"];
        $selected = $selectOption === "$isAdmin" ? "selected" : "";

        echo '
            <option value="' .$selectOption. '"' .$selected. '>' .$selectOption. '</option>
        ';
    }
?>
                </select>
                <select class="update-admin-select" name="is_super_admin" required>
<?php
    foreach($selectOptions as $selectOption) {
        $isSuperAdmin = $admin["is_super_admin"];
        $selected = $selectOption === "$isSuperAdmin" ? "selected" : "";

        echo '
            <option value="' .$selectOption. '"' .$selected. '>' .$selectOption. '</option>
        ';
    }
?>
                </select>
                <button class="update-admin-button" type="submit" name="send">Update Admin</button>
            </form>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
        </div>