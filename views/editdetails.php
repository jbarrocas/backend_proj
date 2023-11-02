<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
    <main>
        <div class="user-details-container">
<?php
    require("templates/menu.php");
?>
            <div class="form-container">
                <form class="details-form" method="POST" action="/editdetails/">
                    <input class="details-input" type="text" name="first_name" placeholder="First Name" value="<?= $user["first_name"] ?>" required minlength="3" maxlength="22">
                    <input class="details-input" type="text" name="last_name" placeholder="Last Name" value="<?= $user["last_name"] ?>" required minlength="2" maxlength="22">
                    <input class="details-input" type="email" name="email" placeholder="Email" value="<?= $user["email"] ?>" required>
                    <select class="details-select" name="country_id" required>
<?php
    foreach($countries as $country) {
        $selected = $country["country_id"] === "PT" ? "selected" : "";

        echo '
            <option value="' .$country["country_id"]. '"' .$selected. '>' .$country["name"]. '</option>
        ';
    }
?>
                    </select>
                    <button class="update-button" type="submit" name="send">Update Details</button>
                </form>
                <p><a href="/changepassword/">Change Password</a></p>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
            </div>
        </div>
    </main>
    
</body>
</html>