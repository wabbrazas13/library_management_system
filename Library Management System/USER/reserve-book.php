<?php
    session_start();
    $user = $_SESSION['user'];

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
    <title>Book Reservation</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 100px;">
        <br>
        <div class="book-reservation-wrapper">
            <h1 class="text-book-reservation">Book Reservation</h1>
            <br><br>

            <?php

                if(isset($_GET['id']))
                {
                    $ISBN = $_GET['id'];
                    $sql = "SELECT * FROM tbl_bookcopy WHERE ISBN='$ISBN' AND book_status='Available' ORDER BY copy_no ASC";
                    $res = mysqli_query($link,$sql);
                    $count = mysqli_num_rows($res);

                    if(mysqli_num_rows($res)>0)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $book_no = $row['book_no'];
                    }

                    $sql1 = "SELECT * FROM tbl_book WHERE ISBN='$ISBN' ";
                    $res1 = mysqli_query($link,$sql1);

                    if(mysqli_num_rows($res1)==1)
                    {
                        $row1 = mysqli_fetch_assoc($res1);
                        $title = $row1['book_title'];
                        $category = $row1['book_category'];
                        $edition = $row1['book_edition'];
                        $author = $row1['book_author'];
                        $publisher = $row1['book_publisher'];
                        $pub_date = $row1['pub_date'];
                        $image = $row1['book_image'];
                    }

                    $sql2 = "SELECT * FROM tbl_user WHERE user_email='$user' ";
                    $res2 = mysqli_query($link,$sql2);

                    if(mysqli_num_rows($res2)==1)
                    {
                        $row2 = mysqli_fetch_assoc($res2);
                        $user_type = $row2['user_type'];
                        $user_id = $row2['user_id'];
                    }

                    ?>
                        <form action="" method="POST">
                            <img src="<?php echo $SITEURL."IMAGES/BOOKS/".$image;?>" style="height: 320px; width: 250px; float: left; padding-right: 20px;">
                            <p class="res-info">
                                ISBN : <?php echo $ISBN; ?><br>
                                Title : <?php echo $title; ?><br>
                                Category : <?php echo $category; ?><br>
                                Edition : <?php echo $edition; ?><br>
                                Author : <?php echo $author; ?><br>
                                Publisher : <?php echo $publisher.", ".$pub_date; ?><br>

                                <?php
                                    if($user_type=='STUDENT')
                                    {
                                        echo "Quantity : 1 item";
                                    }
                                ?>
                            </p>

                            <?php
                                if($user_type=='TEACHER')
                                {
                                    ?>
                                        <br>
                                        <table>
                                            <tr>
                                                <td>Quantity : </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 5px;">
                                                    <input type="number" name="res-qty" placeholder="Enter Quantity">
                                                </td>
                                            </tr>
                                        </table>
                                    <?php
                                }
                            ?>

                            <button type="submit" name="btn-confirm" class="btn-res-confirm">CONFIRM</button>
                            <button type="submit" name="btn-cancel" class="btn-res-cancel">CANCEL</button>
                        </form>

                        <?php

                            if(isset($_POST['btn-cancel']))
                            {
                                ?>
                                    <script>
                                        window.location="books.php";
                                    </script>
                                <?php
                            }

                            if(isset($_POST['btn-confirm']))
                            {
                                $res_date = date('Y/m/d');
                                $res_expiry = date('Y/m/d', strtotime($res_date. '+ 7 days'));

                                if(isset($_POST['res-qty']))
                                {
                                    $quantity = $_POST['res-qty'];

                                    if(empty($quantity)) 
                                    {
                                        $quantity=1;
                                    }
                                }
                                else
                                {
                                    $quantity = 1;
                                }

                                $no = $quantity;

                                if($no>$count)
                                {
                                    ?>
                                        <script>
                                            alert("The quantity exceeds the amount of books available.");
                                            window.location="reserve-book.php?id=<?php echo $ISBN;?>";
                                        </script>
                                    <?php
                                }
                                else
                                {
                                    if($user_type=='STUDENT')
                                    {
                                        $sql7 = "SELECT * FROM tbl_reservation WHERE user_id = '$user_id' ";
                                        $res7 = mysqli_query($link,$sql7);

                                        if(mysqli_num_rows($res7)>2)
                                        {
                                            ?>
                                                <script>
                                                    alert("Reservation Failed. Your only allowed to reserve books three(3) times.");
                                                    window.location="books.php";
                                                </script>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        $sql8 = "SELECT * FROM tbl_reservation WHERE user_id = '$user_id' ";
                                        $res8 = mysqli_query($link,$sql8);

                                        if(mysqli_num_rows($res8)>4)
                                        {
                                            ?>
                                                <script>
                                                    alert("Reservation Failed. Your only allowed to reserve books five(5) times.");
                                                    window.location="books.php";
                                                </script>
                                            <?php
                                        }
                                    }      
                                    
                                    $sql6 = "SELECT * FROM tbl_reservation WHERE ISBN = '$ISBN' AND user_id = '$user_id' ";
                                    $res6 = mysqli_query($link,$sql6);

                                    if(mysqli_num_rows($res6)>0)
                                    {
                                        ?>
                                            <script>
                                                alert("Reservation Failed: Book is already reserved.");
                                                window.location="books.php";
                                            </script>
                                        <?php
                                    }
                                    else
                                    {
                                        while($no>0)
                                        {
                                            $sql3 = "SELECT * FROM tbl_bookcopy WHERE ISBN='$ISBN' AND book_status='Available' ORDER BY copy_no ASC";
                                            $res3 = mysqli_query($link,$sql3);

                                            if(mysqli_num_rows($res3)>0)
                                            {
                                                $row3 = mysqli_fetch_assoc($res3);
                                                $book_no = $row3['book_no']; 
                                            }

                                            $sql4 = "UPDATE tbl_bookcopy 
                                                    SET book_status = 'Reserved'
                                                    WHERE book_no = '$book_no' ";
                                            $res4 = mysqli_query($link,$sql4);

                                            $no--; 
                                        }

                                        $sql5 = "INSERT INTO tbl_reservation (user_id, ISBN, book_quantity, res_date, res_expiry, res_status)
                                                VALUES (('$user_id'), ('$ISBN'), ('$quantity'), '$res_date', '$res_expiry', 'PENDING')";
                                        $res5 = mysqli_query($link,$sql5);

                                        if($res5==true && $res4==true)
                                        {
                                            ?>
                                                <script>
                                                    alert("Reservation added.");
                                                    window.location="books.php";
                                                </script>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <script>
                                                    alert("Reservation failed.");
                                                    window.location="books.php";
                                                </script>
                                            <?php
                                        }
                                    }
                                }

                            }
                        ?>

                    <?php
                }
            ?>
            
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