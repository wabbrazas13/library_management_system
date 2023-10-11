<?php 

    $SITEURL = "http://localhost/librarY%20MANAGEMENT%20SYSTEM/";
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $database = "lms";

    $link = mysqli_connect($db_server, $db_user, $db_pass, $database);

    if (!$link) {
        die("<script>alert('Database Connection Failed.')</script>");
    }

?>