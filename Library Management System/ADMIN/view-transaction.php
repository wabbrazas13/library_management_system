<?php
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
    <title>View Transactions</title>
</head>
<body>
    
    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 260px;">
        <br>
        <div class="manage-books-wrapper">
            <h1 class="text-manage-books">View Transactions</h1>
            <br>
            <a href="book-transaction.php" class="add-book-record-btn">Add Book Transaction</a>
            <br><br>
            <table class="manage-book-record-table">   
                <tr style="background-color: rgb(107, 76, 76); color: skyblue;">
                    <th>#</th>
                    <th>Full Name</th>
                    <th>ISBN</th>
                    <th>Book Title</th>
                    <th>Edition</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_transaction WHERE trans_status = 'BORROWED' OR trans_status = 'RETURNED INCOMPLETE' ";
                    $res = mysqli_query($link,$sql);

                    if(mysqli_num_rows($res)>0)
                    {
                        $count = 1;

                        while($row=mysqli_fetch_assoc($res))
                        {
                            $trans_no = $row['trans_no'];
                            $user_id = $row['user_id'];
                            $ISBN = $row['ISBN'];
                            $book_quantity = $row['book_quantity'];
                            $due_date = $row['due_date'];
                            $trans_status = $row['trans_status'];
                            $returned_qty = $row['returned_qty'];

                            $sql1 = "SELECT * FROM tbl_user WHERE user_id = '$user_id' ";
                            $res1 = mysqli_query($link,$sql1);

                            if(mysqli_num_rows($res1)>0)
                            {
                                $row1 = mysqli_fetch_assoc($res1);
                                $user_fn = $row1['user_fn'];
                                $user_mn = $row1['user_mn'];
                                $user_ln = $row1['user_ln'];
                            }

                            $sql2 = "SELECT * FROM tbl_book WHERE ISBN = '$ISBN' ";
                            $res2 = mysqli_query($link,$sql2);

                            if(mysqli_num_rows($res2)>0)
                            {
                                $row2 = mysqli_fetch_assoc($res2);
                                $book_title = $row2['book_title'];
                                $book_edition = $row2['book_edition'];
                                $book_author = $row2['book_author'];
                            }

                            if($trans_status=='RETURNED INCOMPLETE')
                            {
                                $book_quantity = $book_quantity-$returned_qty;
                            }

                            ?>                     
                                <tr style="background-color: <?php if(($count%2)==0){echo "#ddd";}?>;">
                                    <td><?php echo $count; ?>. &nbsp</td>
                                    <td><?php echo $user_ln.", ".$user_fn." ".substr($user_mn,0,1)."."; ?>&nbsp</td>
                                    <td><?php echo $ISBN; ?></td>
                                    <td><?php echo $book_title; ?></td>
                                    <td style="text-align: center;"><?php echo $book_edition; ?></td>
                                    <td><?php echo $book_author; ?></td>
                                    <td style="text-align: center;"><?php echo $book_quantity; ?></td>
                                    <td style="width: 130px;"><?php echo $due_date; ?></td>
                                    <td style="width: 130px;"><?php echo "BORROWED"; ?></td>
                                <tr>
                            <?php

                            $count++;
                        }
                    }
                    else 
                    {                      
                        ?>
                            <tr>
                                <td colspan="6"><div style="color: red;">No Transactions has been made yet.</div></td>
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