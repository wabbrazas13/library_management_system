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
    <title>Book Request</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 270px;">
        <br>
        <div class="book-req-wrapper">
            <h1 class="text-book-req">Book Request</h1>
            <br><br>
            <a href="view-request.php" class="view-req-btn">View Request</a><br><br><br><br><br><br>
            
            <form action="" method="POST">
                <table class="book-req-tbl">
                    <tr>
                        <td>ISBN : </td>
                        <td>
                            <input type="number" name="ISBN" placeholder="Enter ISBN" style="width: 245px; text-align: center;" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Book Title : </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Book Title" style="width: 245px; text-align: center;" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Edition : </td>
                        <td>
                            <input type="text" name="edition" placeholder="Enter Book Edition" style="width: 245px; text-align: center;" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Author : </td>
                        <td>
                            <input type="text" name="author" placeholder="Enter Author" style="width: 245px; text-align: center;" required>
                        </td>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_user WHERE user_email = '$user' ";
                        $res = mysqli_query($link,$sql);
                        
                        if($res==true)
                        {
                            $row = mysqli_fetch_assoc($res);
                            $user_id = $row['user_id'];
                            $user_type = $row['user_type'];
                        }

                        if($user_type=='TEACHER')
                        {
                            ?>
                                <tr>
                                    <td>Quantity : </td>
                                    <td>
                                        <input type="number" name="req-qty" style="width: 245px;" placeholder="Enter Quantity">
                                    </td>
                                </tr>
                            <?php
                        }

                        ?>
                            <tr>
                                <td>Action : </td>
                                <td>
                                    <button type="submit" name="send-req" class="req-btn">Send Request</button>
                                </td>
                            </tr>
                        <?php
                    ?>
                </table> 
            </form>

            <?php
                if(isset($_POST['send-req']))
                {
                    $ISBN = $_POST['ISBN'];

                    $sql2 = "SELECT * FROM tbl_book WHERE ISBN = '$ISBN' ";
                    $res2 = mysqli_query($link,$sql2);

                    if(mysqli_num_rows($res2)>0)
                    {
                        ?>
                            <script>
                                alert('INVALID: Book is already added in the library.');
                                window.location="request-book.php";
                            </script>
                        <?php
                    }
                    else
                    {
                        $req_date = date('Y/m/d');
                        $req_exp = date('Y/m/d', strtotime($req_date. '+ 30 days'));
    
                        if(isset($_POST['req-qty']))
                        {
                            $req_qty = $_POST['req-qty'];
                        }
                        else
                        {
                            $req_qty = 1;
                        }
    
                        if(isset($_POST['title']))
                        {
                            $book_title = $_POST['title'];
                        }
    
                        if(isset($_POST['author']))
                        {
                            $book_author = $_POST['author'];
                        }
                        
                        if(isset($_POST['edition']))
                        {
                            $book_edition = $_POST['edition'];
                        }
    
                        $sql1 = "INSERT INTO tbl_request (ISBN, user_id, book_title, book_edition, book_author, book_quantity, req_date, req_exp, req_status)
                                VALUES (('$ISBN'), '$user_id', ('$book_title'), ('$book_edition'), ('$book_author'), ('$req_qty'), ('$req_date'), ('$req_exp'), 'PENDING') ";
                        $res1 = mysqli_query($link,$sql1);
    
                        if($res1==true)
                        {
                            ?>
                                <script>
                                    alert('You successfully requested a book/s.');
                                    window.location="request-book.php";
                                </script>
                            <?php
                        }
                        else
                        {
                            ?>
                                <script>
                                    alert('Failed to send request.');
                                    window.location="request-book.php";
                                </script>
                            <?php
                        }
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