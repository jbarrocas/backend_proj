<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="/js/dashboard.js"></script>
</head>
<body>
    <main>
<?php
require("templates/adminmenu.php");
?>
        <h1>Admin Dashboard</h1>
        <div id="AdminActionArea">
            <h2>Admin Action Area</h2>
            <section class="admin-action-area" data-admin="<?= $admin["super_admin"] ?>">
                <div><a href="/postsreports/">Posts Reports</a></div>
                <div><a href="/commentsreports/">Comments Reports</a></div>
                <div><a href="/searchposts/">Search Posts</a></div>
            </section>
            <h2>Admin Area</h2>
            <section class="admin-area" data-admin="<?= $admin["super_admin"] ?>">
                <div><a href="/updateadmindetails/">Update My Details</a></div>
                <div><a href="/report/">Report</a></div>
            </section>
            <h2>Super Admin Area</h2>
            <section class="super-admin-area" data-admin="<?= $admin["super_admin"] ?>">
                <div><a href="/deleteaccountreports/">Deleted Accounts Reports</a></div>
                <div><a href="/createadmin/">Create Admin</a></div>
                <div><a href="/updateadmin/">Update Admin</a></div>
                <div><a href="/deleteadmin/">Delete Admin</a></div>
            </section>
        </div>
    </main>    
</body>
</html>