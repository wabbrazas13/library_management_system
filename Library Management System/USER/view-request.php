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
    <title>View Request</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 250px;">
        <br>
        <div class="my-req-wrapper">
            <h1 class="text-my-req">My Request</h1>
            <br><br>
            <a href="request-book.php" class="req-bknow-btn">Request Book Now</a>

            <table class="my-req-table"> 

                <tr>
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Edition</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Date Requested</th>
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

                    $sql1 = "SELECT * FROM tbl_request WHERE user_id = '$user_id' ORDER BY req_no ASC";
                    $res1 = mysqli_query($link,$sql1);

                    if(mysqli_num_rows($res1)>0)
                    {
                        $no = 1;

                        while($row1=mysqli_fetch_assoc($res1))
                        {
                            $req_no = $row1['req_no'];
                            $ISBN = $row1['ISBN'];
                            $title = $row1['book_title'];
                            $edition = $row1['book_edition'];
                            $author = $row1['book_author'];
                            $quantity = $row1['book_quantity'];
                            $date = $row1['req_date'];
                            $status = $row1['req_status'];

                            ?>
                                <tr>
                                    <td><?php echo $no; ?>.</td>
                                    <td><?php echo $ISBN; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $edition; ?></td>
                                    <td><?php echo $author; ?></td>
                                    <td style="text-align: center;"><?php echo $quantity; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $status; ?></td>

                                    <form action="" method="POST">
                                        <td>
                                            <button type="submit" name="btn-delete" class="btn-req-del">DELETE</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php

                            $no++;
                        }

                        if(isset($_POST['btn-delete']))
                        {
                            $sql2 = "DELETE FROM tbl_request WHERE req_no = '$req_no' ";
                            $res2 = mysqli_query($link,$sql2);

                            if($res2==true)
                            {
                                ?>
                                    <script>
                                        window.location="view-request.php";
                                    </script>
                                <?php
                            }
                        }
                    }
                    else
                    {                      
                        ?>

                            <tr>
                                <td colspan="6"><div style="color: red;">You had not requested a book yet.</div></td>
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