<?php
    include 'connection.php';

    $user_id = $_POST['user-id'];
    $user_fn = $_POST['user-fn'];
    $user_mn = $_POST['user-mn'];
    $user_ln = $_POST['user-ln'];
    $user_gender = $_POST['user-gender'];
    $user_dob = $_POST['user-dob'];
    $user_type = $_POST['user-type'];
    $user_email = $_POST['user-email'];
    $user_password = $_POST['user-password'];
    $confirm_password = $_POST['confirm-password'];

    $sql = "SELECT * FROM tbl_user WHERE user_id = '$user_id' ";
    $res = mysqli_query($link,$sql);

    if(mysqli_num_rows($res)>0)
    {
        ?>
            <script>
                alert("User ID <?php echo $user_id; ?> is already registered.");
                window.location="<?php echo $SITEURL; ?>User_Login.html";
            </script>
        <?php
    }

    $sql1 = "SELECT * FROM tbl_user WHERE user_email = '$user_email' ";
    $res1 = mysqli_query($link,$sql1);

    if(mysqli_num_rows($res1)>0)
    {
        ?>
            <script>
                alert("User email <?php echo $user_email; ?> is already connected to another account.");
                window.location="<?php echo $SITEURL; ?>user_login.php";
            </script>
        <?php
    }

    if($user_password!=$confirm_password)
    {
        ?>
            <script>
                alert("Registration Failed! You may have confirmed the wrong password.");
                window.location="<?php echo $SITEURL; ?>user_registration.php";
            </script>
        <?php
    }

    $sql2 = "INSERT INTO tbl_user (user_id, user_fn, user_mn, user_ln, user_gender, user_dob, user_type, user_email, user_password)
            VALUES ('$user_id', '$user_fn', '$user_mn', '$user_ln', '$user_gender', '$user_dob', '$user_type', '$user_email', ('$user_password'))";
    $res2 = mysqli_query($link,$sql2);

    if($res2==true)
    {
        ?>
            <script>
                alert("You are now registered.");
                window.location="<?php echo $SITEURL; ?>user_login.php";
            </script>
        <?php
    }

    mysqli_close($link);
?>