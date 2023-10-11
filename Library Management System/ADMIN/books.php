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
    <title>Books</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 250px;">
        <br>
        <div class="manage-books-wrapper">
            <h1 class="text-manage-books">Manage Book Records</h1>
            <br><br>
            <a href="<?php echo $SITEURL; ?>ADMIN/add-book.php" class="add-book-record-btn">Add Book Record</a>
            <div class="searchbook">

                <form action="" method="POST">
                    <input type="text" name="txt-search" placeholder="Search Book: Enter ISBN, Book Title, Category, Author, or Keyword" style="font-style: italic; text-align: center; height: 34px; width: 600px; margin-bottom: 10px;">
                    <button type="submit" name="btn-search" style="background-color: blue;"><i class="fa fa-search"></i></button>
                </form>

            </div>
            <table class="manage-book-record-table">   
                <tr style="background-color: rgb(107, 76, 76); color: skyblue;">
                    <th>#</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Edition</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_book ORDER BY book_title ASC, pub_date DESC, book_author ASC, book_edition ASC";
                    $res = mysqli_query($link, $sql);
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        $no=1;
                        while($row=mysqli_fetch_assoc($res)){
                            $ISBN = $row['ISBN'];
                            $title = $row['book_title'];
                            $category = $row['book_category'];
                            $edition = $row['book_edition'];
                            $author = $row['book_author'];
                            $publisher = $row['book_publisher'];
                            $date = $row['pub_date'];
                            $quantity = $row['book_quantity'];
                            ?>                     
                                <tr style="background-color: <?php if(($no%2)==0){echo "#ddd";}?>;">
                                    <td><?php echo $no; ?>. &nbsp</td>
                                    <td><?php echo $ISBN; ?>&nbsp</td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $category; ?></td>
                                    <td><?php echo $edition; ?></td>
                                    <td><?php echo $author; ?></td>
                                    <td><?php echo $publisher; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td style="text-align: center;"><?php echo $quantity; ?></td>
                                    <td style="width: 158px;">
                                        <a href="<?php echo $SITEURL; ?>ADMIN/update-book.php?id=<?php echo $ISBN;?>" class="btn-upd-bk">Update</a>
                                        <a href="<?php echo $SITEURL; ?>ADMIN/delete-book.php?id=<?php echo $ISBN;?>" class="btn-del-bk">Delete</a>
                                    </td>
                                <tr>
                            <?php
                            $no++;
                        }
                    }
                    else 
                    {                      
                        ?>

                            <tr>
                                <td colspan="6"><div style="color: red;">No Book Record Added.</div></td>
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