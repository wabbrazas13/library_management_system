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
    <title>Books Collection</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 250px;">
        <br>
        <div class="books-collection-wrapper">
            <h1 class="text-books-collection">Books Collection</h1>
            <br><br>
            <a href="view-reservation.php" class="view-reservations-btn">View Reservations</a>
            <div class="searchbook">
                <form action="" method="POST">
                    <input type="text" name="txt-search" placeholder="Search Book: Enter ISBN, Book Title, Category, Author, or Keyword" style="font-style: italic; text-align: center; height: 34px; width: 600px; margin-bottom: 10px;">
                    <button type="submit" name="btn-search" style="background-color: blue;"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <table class="books-collection-table">   
                <tr>
                    <th>Image</th>
                    <th>Information</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_book ORDER BY book_title ASC";
                    $res = mysqli_query($link, $sql);
                    $count = mysqli_num_rows($res);
                    
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res)){
                            $ISBN = $row['ISBN'];
                            $title = $row['book_title'];
                            $category = $row['book_category'];
                            $edition = $row['book_edition'];
                            $author = $row['book_author'];
                            $image = $row['book_image'];
                            $desc = $row['book_description'];
                            ?>                     
                                <tr>
                                    <td style="width: 200px;"><img src="<?php echo $SITEURL."IMAGES/BOOKS/".$image;?>" style="height: 200px; width: 150px;"></td>
                                    <td style="width: 300px; letter-spacing: 1px; line-height: 28px;">
                                        <p>
                                            ISBN: <?php echo $ISBN;?><br>
                                            Book Title: <?php echo $title;?><br>
                                            Category: <?php echo $category;?><br>
                                            Edition: <?php echo $edition;?><br>
                                            Author: <?php echo $author;?><br>
                                        </p>
                                    </td>
                                    <td>
                                        <p style="text-align: justify; letter-spacing: 1.5px; line-height: 28px;">
                                            <?php echo $desc;?>
                                        </p>
                                    </td>
                                    <td style="width: 170px;">
                                        <?php
                                            $sql1 = "SELECT * FROM tbl_bookcopy WHERE ISBN='$ISBN' AND book_status='Available' ORDER BY book_no ASC";
                                            $res1 = mysqli_query($link,$sql1);
                                            $count1 = mysqli_num_rows($res1);
                                        ?>
                                        <p style="font-size: 15px; line-height: 28px;">Available Qty : <?php echo $count1; ?></p><br>
                                        <?php
                                            if($count1 > 0)
                                            {
                                                ?>
                                                    <a href="<?php echo $SITEURL; ?>USER/reserve-book.php?id=<?php echo $ISBN;?>" class="btn-res1-bk">Reserve Now</a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <a href="" class="btn-res2-bk">Unavailable</a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                <tr>
                            <?php
                        }
                    }
                    else 
                    {                      
                        ?>

                            <tr>
                                <td colspan="6"><div style="color: red;">There is no books available to display.</div></td>
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