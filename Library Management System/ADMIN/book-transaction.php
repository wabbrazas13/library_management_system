<?php
    session_start();

    if(isset($_SESSION['admin']))
    {
        $admin_email = $_SESSION['admin'];
    }

    include 'connection.php';

    $sql = "SELECT * FROM tbl_admin WHERE admin_email = '$admin_email' ";
    $res = mysqli_query($link,$sql);

    if(mysqli_num_rows($res)==1)
    {
        $row = mysqli_fetch_assoc($res);
        $admin_id = $row['admin_id'];
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
    <title>Book Transaction</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 270px;">
        <br>
        <div class="bk-trans-wrapper">
            <h1 class="text-bk-trans">Book Transaction</h1>
            <br><br>
            <a href="view-transaction.php" class="view-transaction-btn">View Transactions</a><br><br><br><br><br><br>
            
            <form action="" method="POST">
                <table class="bk-trans-tbl">
                    <tr>
                        <td>ISBN : </td>
                        <td>
                            <input type="number" name="ISBN" placeholder="Enter ISBN" style="width: 330px; text-align: center;" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>User ID : </td>
                        <td>
                            <input type="text" name="user_id" placeholder="Enter User ID" style="width: 330px; text-align: center;" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Quantity : </td>
                        <td>
                            <input type="number" name="quantity" placeholder="Enter Quantity" style="width: 330px; text-align: center;" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Action : </td>
                        <td>
                            <input type="submit" name="btn-borrow" class="bk-trans-btn" value="Borrow">
                            <input type="submit" name="btn-renew" class="bk-trans-btn" value="Renew">
                            <input type="submit" name="btn-return" class="bk-trans-btn" value="Return">
                        </td>
                    </tr>
                </table> 
            </form>

            <?php
                if(isset($_POST['btn-borrow']))
                {                 
                    $ISBN = $_POST['ISBN'];
                    $user_id = $_POST['user_id'];
                    $quantity = $_POST['quantity'];
                    $book_quantity = $quantity;

                    $sql20 = "SELECT * FROM tbl_user WHERE user_id = '$user_id' ";
                    $res20 = mysqli_query($link,$sql20);

                    if($res20==true)
                    {
                        $row20=mysqli_fetch_assoc($res20);
                        $user_type = $row20['user_type'];
                    }

                    $sql21 = "SELECT * FROM tbl_transaction WHERE user_id = '$user_id' AND trans_status != 'RETURNED COMPLETE' ";
                    $res21 = mysqli_query($link,$sql21);
                    $count21 = mysqli_num_rows($res21);

                    if($count21>=3 && $user_type='STUDENT')
                    {
                        ?>
                            <script>
                                alert("WARNING: Maximum number Of transactions exceeded.");
                                window.location="book-transaction.php";
                            </script>
                        <?php
                    }
                    else
                    {
                        $sql1 = "SELECT * FROM tbl_reservation WHERE user_id = '$user_id' AND ISBN = '$ISBN' ";
                        $res1 = mysqli_query($link,$sql1);

                        if(mysqli_num_rows($res1)==1)
                        {
                            $row1=mysqli_fetch_assoc($res1);
                            $quantity1 = $row1['book_quantity'];
                            
                            if($quantity<=$quantity1)
                            {
                                $quantity4 = $quantity1-$quantity;

                                for($i=0; $i<$quantity; $i++)
                                {
                                    $sql12 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Reserved' ORDER BY copy_no ASC";
                                    $res12 = mysqli_query($link,$sql12);

                                    if($res12==true)
                                    {
                                        $row12=mysqli_fetch_assoc($res12);
                                        $book_no = $row12['book_no'];
                                    }

                                    $sql5 = "UPDATE tbl_bookcopy SET book_status = 'Not Available' WHERE book_no = '$book_no' ";
                                    $res5 = mysqli_query($link,$sql5);
                                }

                                if($quantity4>0)
                                {
                                    $sql6 = "UPDATE tbl_reservation SET book_quantity = '$quantity4' WHERE ISBN = '$ISBN' AND user_id = '$user_id' ";
                                    $res6 = mysqli_query($link,$sql6);
                                }
                                else
                                {
                                    $sql7 = "DELETE FROM tbl_reservation WHERE ISBN = '$ISBN' AND user_id = '$user_id' ";
                                    $res7 = mysqli_query($link,$sql7);
                                }

                                $borrow_date = date('Y/m/d');
                                $due_date = date('Y/m/d', strtotime($borrow_date. '+ 7 days'));

                                $sql18 = "SELECT * FROM tbl_transaction WHERE user_id = '$user_id' AND ISBN = '$ISBN' AND trans_status = 'BORROWED' ";
                                $res18 = mysqli_query($link,$sql18);

                                if(mysqli_num_rows($res18)>0){
                                    $row18=mysqli_fetch_assoc($res18);
                                    $quantity7 = $row18['book_quantity'];
                                    $trans_no = $row18['trans_no'];
                                    $quantity8 = $book_quantity+$quantity7;

                                    $sql19 = "  UPDATE tbl_transaction 
                                                SET book_quantity = '$quantity8', borrow_date = '$borrow_date', due_date = '$due_date', admin_id = '$admin_id'
                                                WHERE trans_no = '$trans_no' ";
                                    $res19 = mysqli_query($link,$sql19);

                                    if($res19==true)
                                    {
                                        ?>
                                            <script>
                                                    alert("Transaction record updated.");
                                                    window.location="book-transaction.php";
                                            </script>
                                        <?php
                                    }
                                }
                                else
                                {
                                    $sql11 = "INSERT INTO tbl_transaction (user_id, ISBN, book_quantity, borrow_date, due_date, trans_status, admin_id)
                                    VALUES ('$user_id','$ISBN','$book_quantity','$borrow_date','$due_date','BORROWED','$admin_id')";
                                    $res11 = mysqli_query($link,$sql11);
                
                                    if($res11==true)
                                    {
                                        ?>
                                            <script>
                                                    alert("Transaction record added.");
                                                    window.location="book-transaction.php";
                                            </script>
                                        <?php
                                    }
                                }
            
                            }
                            else
                            {
                                $sql2 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Available' ";
                                $res2 = mysqli_query($link,$sql2);
                                $count2 = mysqli_num_rows($res2);
                                $quantity2 = $count2 + $quantity1;

                                if($quantity>$quantity2)
                                {
                                    $quantity5 = $quantity-$quantity2;
                                    ?>
                                        <script>
                                            alert("FAILED: The other <?php echo $quantity5; ?> book <?php if($quantity5>1){echo "s are";}else{echo "is";}?> UNAVAILABLE.");
                                            window.location="book-transaction.php";
                                        </script>
                                    <?php
                                }
                                else
                                {
                                    $sql8 = "DELETE FROM tbl_reservation WHERE ISBN = '$ISBN' AND user_id = '$user_id' ";
                                    $res8 = mysqli_query($link,$sql8);

                                    $quantity3 = $quantity-$quantity1;

                                    while($quantity1>0)
                                    {
                                        $sql13 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Reserved' ORDER BY copy_no ASC";
                                        $res13 = mysqli_query($link,$sql13);

                                        if($res13==true)
                                        {
                                            $row13=mysqli_fetch_assoc($res13);
                                            $book_no = $row13['book_no'];
                                        }

                                        $sql3 = "UPDATE tbl_bookcopy SET book_status = 'Not Available' WHERE book_no = '$book_no' ";
                                        $res3 = mysqli_query($link,$sql3);

                                        if($res3==true)
                                        {
                                            $quantity1--;
                                        }
                                    }

                                    while($quantity3>0)
                                    {
                                        $sql14 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Available' ORDER BY copy_no ASC";
                                        $res14 = mysqli_query($link,$sql14);

                                        if($res14==true)
                                        {
                                            $row14=mysqli_fetch_assoc($res14);
                                            $book_no = $row14['book_no'];
                                        }

                                        $sql4 = "UPDATE tbl_bookcopy SET book_status = 'Not Available' WHERE book_no = '$book_no' ";
                                        $res4 = mysqli_query($link,$sql4);

                                        if($res4==true)
                                        {
                                            $quantity3--;
                                        }
                                    }

                                    $borrow_date = date('Y/m/d');
                                    $due_date = date('Y/m/d', strtotime($borrow_date. '+ 7 days'));
                
                                    $sql18 = "SELECT * FROM tbl_transaction WHERE user_id = '$user_id' AND ISBN = '$ISBN' AND trans_status = 'BORROWED' ";
                                    $res18 = mysqli_query($link,$sql18);

                                    if(mysqli_num_rows($res18)>0){
                                        $row18=mysqli_fetch_assoc($res18);
                                        $quantity7 = $row18['book_quantity'];
                                        $trans_no = $row18['trans_no'];
                                        $quantity8 = $book_quantity+$quantity7;

                                        $sql19 = "  UPDATE tbl_transaction 
                                                    SET book_quantity = '$quantity8', borrow_date = '$borrow_date', due_date = '$due_date', admin_id = '$admin_id'
                                                    WHERE trans_no = '$trans_no' ";
                                        $res19 = mysqli_query($link,$sql19);

                                        if($res19==true)
                                        {
                                            ?>
                                                <script>
                                                        alert("Transaction record updated.");
                                                        window.location="book-transaction.php";
                                                </script>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        $sql11 = "INSERT INTO tbl_transaction (user_id, ISBN, book_quantity, borrow_date, due_date, trans_status, admin_id)
                                        VALUES ('$user_id','$ISBN','$book_quantity','$borrow_date','$due_date','BORROWED','$admin_id')";
                                        $res11 = mysqli_query($link,$sql11);
                    
                                        if($res11==true)
                                        {
                                            ?>
                                                <script>
                                                        alert("Transaction record added.");
                                                        window.location="book-transaction.php";
                                                </script>
                                            <?php
                                        }
                                    }
                
                                }
                            }
                        }
                        else
                        {
                            $sql9 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Available' ";
                            $res9 = mysqli_query($link,$sql9);
                            $count9 = mysqli_num_rows($res9);

                            if($quantity>$count9)
                            {
                                $quantity6 = $quantity-$count9;

                                ?>
                                    <script>
                                        alert("FAILED: The other <?php echo $quantity6; ?> book <?php if($quantity6>1){echo "s are";}else{echo "is";}?> UNAVAILABLE.");
                                        window.location="book-transaction.php";
                                    </script>
                                <?php
                            }
                            else
                            {
                                while($quantity>0)
                                {
                                    $sql15 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Available' ORDER BY copy_no ASC";
                                    $res15 = mysqli_query($link,$sql15);

                                    if($res15==true)
                                    {
                                        $row15=mysqli_fetch_assoc($res15);
                                        $book_no = $row15['book_no'];
                                    }

                                    $sql10 = "UPDATE tbl_bookcopy SET book_status = 'Not Available' WHERE book_no = '$book_no' ";
                                    $res10 = mysqli_query($link,$sql10);

                                    if($res10==true)
                                    {
                                        $quantity--;
                                    }
                                }

                                $borrow_date = date('Y/m/d');
                                $due_date = date('Y/m/d', strtotime($borrow_date. '+ 7 days'));
            
                                $sql18 = "SELECT * FROM tbl_transaction WHERE user_id = '$user_id' AND ISBN = '$ISBN' AND trans_status = 'BORROWED' ";
                                $res18 = mysqli_query($link,$sql18);

                                if(mysqli_num_rows($res18)>0){
                                    $row18=mysqli_fetch_assoc($res18);
                                    $quantity7 = $row18['book_quantity'];
                                    $trans_no = $row18['trans_no'];
                                    $quantity8 = $book_quantity+$quantity7;

                                    $sql19 = "  UPDATE tbl_transaction 
                                                SET book_quantity = '$quantity8', borrow_date = '$borrow_date', due_date = '$due_date', admin_id = '$admin_id'
                                                WHERE trans_no = '$trans_no' ";
                                    $res19 = mysqli_query($link,$sql19);

                                    if($res19==true)
                                    {
                                        ?>
                                            <script>
                                                    alert("Transaction record updated.");
                                                    window.location="book-transaction.php";
                                            </script>
                                        <?php
                                    }
                                }
                                else
                                {
                                    $sql11 = "INSERT INTO tbl_transaction (user_id, ISBN, book_quantity, borrow_date, due_date, trans_status, admin_id)
                                    VALUES ('$user_id','$ISBN','$book_quantity','$borrow_date','$due_date','BORROWED','$admin_id')";
                                    $res11 = mysqli_query($link,$sql11);
                
                                    if($res11==true)
                                    {
                                        ?>
                                            <script>
                                                    alert("Transaction record added.");
                                                    window.location="book-transaction.php";
                                            </script>
                                        <?php
                                    }
                                }
            
                            }
                        }
                    }
                }

                if(isset($_POST['btn-renew']))
                {
                    $ISBN = $_POST['ISBN'];
                    $user_id = $_POST['user_id'];
                    $quantity = $_POST['quantity'];

                    $sql16 = "SELECT * FROM tbl_transaction WHERE ISBN = '$ISBN' AND user_id = '$user_id' AND book_quantity = '$quantity' AND renew_date IS NULL ";
                    $res16 = mysqli_query($link,$sql16);

                    if(mysqli_num_rows($res16)>0)
                    {
                        $row16=mysqli_fetch_assoc($res16);
                        $trans_no = $row16['trans_no'];
                        $due_date = $row16['due_date'];

                        $renew_date = date('Y/m/d');
                        $new_due_date = date('Y/m/d', strtotime($due_date. '+ 7 days'));

                        $sql17 = "  UPDATE tbl_transaction 
                                    SET due_date = '$new_due_date', renew_date = '$renew_date', trans_status = 'BORROWED', admin_id = '$admin_id'
                                    WHERE trans_no = '$trans_no' ";
                        $res17 = mysqli_query($link,$sql17);

                        if($res17==true)
                        {
                            ?>
                                <script>
                                    alert("SUCCESS: Transaction renewed.");
                                    window.location="book-transaction.php";
                                </script>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <script>
                                alert("FAILED: Transaction record not found OR \nBook_quantity is lacking/excess OR \nRenewing more than once is prohibited.");
                                window.location="book-transaction.php";
                            </script>
                        <?php
                    }
                }

                if(isset($_POST['btn-return']))
                {
                    $ISBN = $_POST['ISBN'];
                    $user_id = $_POST['user_id'];
                    $returned_qty = $_POST['quantity'];
                    $returned_qty1 = $_POST['quantity'];
                    $returned_date = date('Y/m/d');

                    $sql22 = "SELECT * FROM tbl_transaction WHERE ISBN = '$ISBN' AND user_id = '$user_id' AND trans_status = 'BORROWED' OR trans_status = 'RETURNED INCOMPLETE' ";
                    $res22 = mysqli_query($link,$sql22);

                    if(mysqli_num_rows($res22)>0)
                    {
                        $row22=mysqli_fetch_assoc($res22);
                        $book_quantity = $row22['book_quantity'];
                        $due_date = $row22['due_date'];
                        $ret_prev_qty = $row22['returned_qty'];

                        if(empty($ret_prev_qty))
                        {
                            $ret_prev_qty=0;
                        }
                        else
                        {
                            $returned_qty=$ret_prev_qty+$returned_qty;
                        }

                        $returned_date1 = strtotime($returned_date);
                        $due_date1 = strtotime($due_date);
                        $diff = $due_date1-$returned_date1;
                        $days = floor($diff/(60*60*24));

                        if($days>=0)
                        {
                            $returned_remarks = 'ON TIME';
                        }
                        else
                        {
                            $returned_remarks = 'LATE';
                        }

                        if($returned_qty<$book_quantity)
                        {
                            $trans_status = 'RETURNED INCOMPLETE';
                        }
                        else
                        {
                            $returned_qty1=$book_quantity-$ret_prev_qty;
                            $returned_qty=$book_quantity;
                            $trans_status = 'RETURNED COMPLETE';
                        }

                        $sql23 = "  UPDATE tbl_transaction
                                    SET returned_date = '$returned_date', returned_qty = '$returned_qty', admin_id = '$admin_id', trans_status = '$trans_status', returned_remarks = '$returned_remarks' 
                                    WHERE user_id = '$user_id' AND ISBN = '$ISBN' AND trans_status = 'BORROWED' OR trans_status = 'RETURNED INCOMPLETE' ";
                        $res23 = mysqli_query($link,$sql23);

                        if($res23==true)
                        {
                            $quantity=$returned_qty1;

                            while($quantity>0)
                            {
                                $sql15 = "SELECT * FROM tbl_bookcopy WHERE ISBN = '$ISBN' AND book_status = 'Not Available' ORDER BY copy_no ASC";
                                $res15 = mysqli_query($link,$sql15);

                                if($res15==true)
                                {
                                    $row15=mysqli_fetch_assoc($res15);
                                    $book_no = $row15['book_no'];
                                }

                                $sql10 = "UPDATE tbl_bookcopy SET book_status = 'Available' WHERE book_no = '$book_no' ";
                                $res10 = mysqli_query($link,$sql10);

                                if($res10==true)
                                {
                                    $quantity--;
                                }
                            }

                            ?>
                                <script>
                                    alert("Book successfully returned.");
                                    window.location="book-transaction.php";
                                </script>
                            <?php
                        }
                        else
                        {
                            ?>
                                <script>
                                    alert("Failed to excute return command.");
                                    window.location="book-transaction.php";
                                </script>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <script>
                                alert("Transaction record not found.");
                                window.location="book-transaction.php";
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