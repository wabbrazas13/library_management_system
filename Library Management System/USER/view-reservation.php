<?php
    session_start();
    $user_email = $_SESSION['user'];

    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>View Reservation</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 250px;">
        <br>
        <div class="my-res-wrapper">
            <h1 class="text-my-res">My Reservation</h1>
            <br><br>
            <a href="books.php" class="res-bknow-btn">Reserve Book Now</a>

            <table class="my-res-table"> 

                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Edition</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Valid Until</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                    
                    $sql = "SELECT * FROM tbl_user WHERE user_email = '$user_email' ";
                    $res = mysqli_query($link,$sql);

                    if($res==true)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $user_id = $row['user_id'];
                    }

                    $sql1 = "SELECT * FROM tbl_reservation WHERE user_id = '$user_id' ORDER BY res_no ASC";
                    $res1 = mysqli_query($link,$sql1);

                    if(mysqli_num_rows($res1)>0)
                    {
                        $count = 1;

                        while($row1 = mysqli_fetch_assoc($res1))
                        {
                            $ISBN = $row1['ISBN'];
                            $res_no = $row1['res_no'];
                            $expiration = $row1['res_expiry'];
                            $status = $row1['res_status'];
                            $quantity = $row1['book_quantity'];

                            $sql2 = "SELECT * FROM tbl_book WHERE ISBN = '$ISBN' ";
                            $res2 = mysqli_query($link,$sql2);

                            if($res2==true)
                            {
                                $row2 = mysqli_fetch_assoc($res2);
                                $title = $row2['book_title'];
                                $edition = $row2['book_edition'];
                                $author = $row2['book_author'];
                            }

                            $no = $quantity;

                            ?>
                                <tr>
                                    <td><?php echo $count; ?>.</td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $edition; ?></td>
                                    <td><?php echo $author; ?></td>
                                    <td style="text-align: center;"><?php echo $quantity; ?></td>
                                    <td><?php echo $expiration; ?></td>
                                    <td><?php echo $status; ?></td>

                                    <form action="" method="POST">
                                        <td>
                                            <button type="submit" name="btn-cancel" class="btn-res-cancel">CANCEL</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php
                            
                            $count++;
                        }

                        if(isset($_POST['btn-cancel']))
                        {
                            $sql3 = "DELETE FROM tbl_reservation WHERE res_no = '$res_no' ";
                            $res3 = mysqli_query($link,$sql3);

                            if($res3==true)
                            {
                                while($no>0)
                                {
                                    $sql4 = "SELECT * FROM tbl_bookcopy WHERE ISBN='$ISBN' AND book_status='Reserved' ORDER BY copy_no ASC";
                                    $res4 = mysqli_query($link,$sql4);

                                    if($res4==true)
                                    {
                                        $row4 = mysqli_fetch_assoc($res4);
                                        $book_no = $row4['book_no']; 
                                    }

                                    $sql5 = "UPDATE tbl_bookcopy 
                                            SET book_status = 'Available'
                                            WHERE book_no = '$book_no' ";
                                    $res5 = mysqli_query($link,$sql5);

                                    $no--; 
                                }

                                if($res5==true)
                                {
                                    ?>
                                        <script>
                                            window.location="view-reservation.php";
                                        </script>
                                    <?php
                                }
                            }
                        }
                        
                    }
                    else
                    {                      
                        ?>

                            <tr>
                                <td colspan="6"><div style="color: red;">You had not reserved a book yet.</div></td>
                            </tr>

                        <?php
                    }

                ?>

            </table>
        </div>
    </section>

    <footer>
        <?php
            include('footer.php');
            mysqli_close($link);
        ?>
    </footer>

</body>
</html>