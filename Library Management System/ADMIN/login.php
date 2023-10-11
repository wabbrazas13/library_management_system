<?php
    session_start();
    $_SESSION['admin'] = $_POST['admin_email'];
    session_write_close();

    include 'connection.php';

    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $sql = "SELECT * FROM tbl_admin WHERE admin_email = '$admin_email' AND admin_password = '$admin_password'";
    $res = mysqli_query($link, $sql);

    if(mysqli_num_rows($res) == 1)
    {
        ?>
            <script type="text/javascript">
                alert("Your about to login.");
                window.location="admin.php";
            </script>
        <?php
    }
    else
    {
        ?>
            <script type="text/javascript">
                alert("The username or password doesn't match.");
                window.location="<?php echo $SITEURL; ?>admin_login.php";
            </script>
        <?php
    }

    mysqli_close($link);
?>