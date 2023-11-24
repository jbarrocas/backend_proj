<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <main>
<?php
require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Admin Dashboard</h1>
            <div id="AdminActionArea">            
                <section class="admin-action-area">
                    <h2 class="heading-2">Admin Action Area</h2>
                    <ul>
                        <a href="/admin_postreports/"><li class="admin-blue-button">Posts Reports</li></a>
                        <a href="/admin_commentreports/"><li class="admin-white-button">Comments Reports</li></a>
                        <a href="/admin_report/"><li class="admin-red-button">Report to Administration</li></a>
                    </ul>
                </section>
<?php
    if(isset($_SESSION["is_super_admin"])) {
        echo '
            <section class="super-admin-area">
                <h2 class="heading-2">Super Admin Area</h2>
                <ul>
                    <a href="/admin_list/"><li class="admin-blue-button">Admins List</li></a>
                    <a href="/admin_reports/"><li class="admin-white-button">Admins Reports</li></a>
                    <a href="/admin_search_user/"><li class="admin-red-button">Search User</li></a>
                    <a href="/admin_deletedaccountreports/"><li class="admin-blue-button">Deleted Accounts Reports</li></a>
                </ul>
            </section>
        ';
    }
?>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>