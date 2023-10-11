<?php
    session_start();
    
    if(isset($_SESSION['admin']))
    {
        $admin_email = $_SESSION['admin'];
    }
    
    if(isset($_SESSION['checked']))
    {
        if($_SESSION['checked']=='true')
        {
            $check = 'checked';
            $DE = 'DE';
        }
        else
        {
            $check ='';
            $DE = '';
        } 
    }
    else
    {
        $check = '';
        $DE = '';
    }

    include 'connection.php';

    $sql4 = "SELECT * FROM tbl_admin WHERE admin_email = '$admin_email' ";
    $res4 = mysqli_query($link,$sql4);

    if(mysqli_num_rows($res4)==1)
    {
        $row4 = mysqli_fetch_assoc($res4);
        $admin_id = $row4['admin_id'];
    }
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

    <section style="height: fit-content; padding-bottom: 260px;">
        <br>
        <div class="bkres-wrapper">
            <br><br>
            <h1 class="text-bkres">Book Reservation</h1>
            <br>
            <form action="" method="POST">
                <div class="bkres-tbl-wrapper">
                    <table class="bkres-table">
                        <thead>
                            <th style="width: 40px;"></th>
                            <th style="width: 50px;">No</th>
                            <th style="width: 110px;">User ID</th>
                            <th style="width: 170px;">Full Name</th>
                            <th style="width: 160px;">ISBN</th>
                            <th style="width: 220px;">Book Title</th>
                            <th style="width: 90px;">Edition</th>
                            <th style="width: 220px;">Author</th>
                            <th style="width: 70px;">Qty.</th>
                            <th style="width: 150px;">Valid Until</th>
                            <th style="width: 130px;">Status</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM tbl_reservation WHERE res_status = 'PENDING' ";
                                $res = mysqli_query($link,$sql);

                                if(mysqli_num_rows($res))
                                {
                                    $no = 1;
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $res_no = $row['res_no'];
                                        $user_id = $row['user_id'];
                                        $ISBN = $row['ISBN'];
                                        $book_quantity = $row['book_quantity'];
                                        $res_date = $row['res_date'];
                                        $res_expiry = $row['res_expiry'];
                                        $res_status = $row['res_status'];

                                        $sql1 = "SELECT * FROM tbl_user WHERE user_id = '$user_id' ";
                                        $res1 = mysqli_query($link,$sql1);

                                        if(mysqli_num_rows($res1)==1)
                                        {
                                            $row1 = mysqli_fetch_assoc($res1);
                                            $user_fn = $row1['user_fn'];
                                            $user_mn = $row1['user_mn'];
                                            $user_ln = $row1['user_ln'];
                                        }

                                        $sql2 = "SELECT * FROM tbl_book WHERE ISBN = '$ISBN' ";
                                        $res2 = mysqli_query($link,$sql2);

                                        if(mysqli_num_rows($res2)==1)
                                        {
                                            $row2 = mysqli_fetch_assoc($res2);
                                            $book_title = $row2['book_title'];
                                            $book_edition = $row2['book_edition'];
                                            $book_author = $row2['book_author'];
                                        }

                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="select[]" value="<?php echo $res_no; ?>" <?php echo $check; ?>>
                                                </td>
                                                <td><?php echo $no; ?>. </td>
                                                <td><?php echo $user_id; ?></td>
                                                <td><?php echo $user_fn." ".substr($user_mn,0,1).". ".$user_ln; ?></td>
                                                <td><?php echo $ISBN; ?></td>
                                                <td><?php echo $book_title; ?></td>
                                                <td><?php echo $book_edition; ?></td>
                                                <td><?php echo $book_author; ?></td>
                                                <td><?php echo $book_quantity; ?></td>
                                                <td><?php echo $res_expiry; ?></td>
                                                <td><?php echo $res_status; ?></td>
                                            </tr>
                                        <?php

                                        $no++;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div style="float: right;">
                    <button type="submit" name="select_all_btn" class="w3-button w3-round-xxlarge w3-yellow w3-border w3-border-grey w3-hover-black"><?php echo $DE; ?>SELECT ALL</button>
                    <button type="submit" name="confirm_btn" class="w3-button w3-round-xxlarge w3-green w3-border w3-border-grey w3-hover-black">CONFIRM</button>
                    <button type="submit" name="ignore_btn" class="w3-button w3-round-xxlarge w3-red w3-border w3-border-grey w3-hover-black">IGNORE</button>
                </div>
            </form>

            <?php
                if(isset($_POST['select_all_btn']))
                {
                    if($check=='')
                    {
                        $_SESSION['checked'] = 'true';
                    }
                    else
                    {
                        $_SESSION['checked'] = '';
                    }
                }

                if(isset($_POST['confirm_btn']))
                {
                    $date = date('Y/m/d');
                    $date1 = date('Y/m/d', strtotime($date. '+ 3 days'));

                    if(!empty($_POST['select']))
                    {
                        foreach($_POST['select'] as $id)
                        {
                            $sql3 = "UPDATE tbl_reservation SET res_status = 'CONFIRMED', admin_id = '$admin_id', res_expiry = '$date1' WHERE res_no = '$id' ";
                            $res3 = mysqli_query($link,$sql3);

                            if($res3==true)
                            {
                                ?>
                                    <script>
                                        alert("Selected reservations has been confirmed.");
                                        window.location="book-reservation.php";
                                    </script>
                                <?php
                            }
                        }
                    }
                    else
                    {
                        ?>
                            <script>
                                alert("You have not selected anything yet.");
                                window.location="book-reservation.php";
                            </script>
                        <?php
                    }
                }
                if(isset($_POST['ignore_btn']))
                {
                    if(!empty($_POST['select']))
                    {
                        foreach($_POST['select'] as $id)
                        {
                            $sql5 = "UPDATE tbl_reservation SET res_status = 'IGNORED', admin_id = '$admin_id' WHERE res_no = '$id' ";
                            $res5 = mysqli_query($link,$sql5);

                            if($res5==true)
                            {
                                ?>
                                    <script>
                                        alert("Selected reservations has been ingored.");
                                        window.location="book-reservation.php";
                                    </script>
                                <?php
                            }
                        }
                    }
                    else
                    {
                        ?>
                            <script>
                                alert("You have not selected anything yet.");
                                window.location="book-reservation.php";
                            </script>
                        <?php
                    }
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