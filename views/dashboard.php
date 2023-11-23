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
                        <li class="admin-blue-button"><a href="/admin_postreports/">Posts Reports</a></li>
                        <li class="admin-white-button"><a href="/admin_commentreports/">Comments Reports</a></li>
                        <li class="admin-red-button"><a href="/admin_report/">Report to Administration</a></li>
                    </ul>
                </section>
<?php
    if(isset($_SESSION["is_super_admin"])) {
        echo '
            <section class="super-admin-area">
                <h2 class="heading-2">Super Admin Area</h2>
                <ul>
                    <li class="admin-blue-button"><a href="/admin_list/">Admins List</a></li>
                    <li class="admin-white-button"><a href="/admin_reports/">Admins Reports</a></li>
                    <li class="admin-red-button"><a href="/admin_search_user/">Search User</a></li>
                    <li class="admin-blue-button"><a href="/admin_accountreports/">Deleted Accounts Reports</a></li>
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