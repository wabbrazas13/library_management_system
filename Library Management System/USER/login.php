<?php
    session_start();
    $_SESSION['user'] = $_POST['user-email'];
    session_write_close();
    
    include 'connection.php';

    $user_email = $_POST['user-email'];
    $user_password = $_POST['user-password'];

    $sql = "SELECT * FROM tbl_user WHERE user_email='$user_email' ";
    $res = mysqli_query($link,$sql);

    if(mysqli_num_rows($res)>0)
    {
        $sql1 = "SELECT * FROM tbl_user WHERE user_email='$user_email' ";
        $res1 = mysqli_query($link,$sql1);

        $row = mysqli_fetch_assoc($res1);
        $confirm_password = $row['user_password'];

        if($user_password==$confirm_password)
        {
            ?>
                <script>
                    alert("You are about to login.");
                    window.location="books.php";
                </script>
            <?php
        }
        else
        {
            ?>
                <script>
                    alert("You entered the wrong password.");
                    window.location="<?php echo $SITEURL; ?>user_login.php";
                </script>
            <?php
        }
    }
    else
    {
        ?>
            <script>
                alert("You entered an unregistered username.");
                window.location="<?php echo $SITEURL; ?>user_login.php";
            </script>
        <?php
    }
?>