<?php
    include 'connection.php';

    if(isset($_GET['id']))
    {
        $ISBN = $_GET['id'];

        $sql = "DELETE FROM tbl_book WHERE ISBN='$ISBN' ";
        $res = mysqli_query($link, $sql);

        $sql1 = "DELETE FROM tbl_bookcopy WHERE ISBN='$ISBN' ";
        $res1 = mysqli_query($link, $sql1);

        $sql2 = "DELETE FROM tbl_reservation WHERE ISBN='$ISBN' ";
        $res2 = mysqli_query($link, $sql2);

        if($res==true && $res1==true && $res2==true)
        {
            ?>
                <script>
                    window.location="books.php";
                </script>
            <?php
        }
        else
        {
            ?>
                <script>
                    alert("Failed to delete record.");
                    window.location="books.php";
                </script>
            <?php
        }
    }
?>