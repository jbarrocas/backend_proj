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
            <section class="admin-action-area" data-admin="<?= $admin["super_admin"] ?>">
                <h2>Admin Action Area</h2>
                <div><a href="/admin_postreports/">Posts Reports</a></div>
                <div><a href="/commentsreports/">Comments Reports</a></div>
                <div><a href="/searchposts/">Search Posts</a></div>
                <div><a href="/report/">Report</a></div>
            </section>
            <section class="super-admin-area" data-admin="<?= $admin["super_admin"] ?>">
                <h2>Super Admin Area</h2>
                <div><a href="/deleteaccountreports/">Deleted Accounts Reports</a></div>
                <div><a href="/admin_createadmin/">Create Admin</a></div>
                <div><a href="/updateadmin/">Update Admin</a></div>
                <div><a href="/deleteadmin/">Delete Admin</a></div>
            </section>
        </div>
    </main>    
</body>
</html>