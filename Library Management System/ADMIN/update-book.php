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
    <title>Update Book Record</title>
</head>

<body>
    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: fit-content; padding-bottom: 50px;">
        <br>

        <div class="add-book-wrapper">
            <h1 class="text-add-book">Update Book Records</h1>
            <br><br>

            <?php
                if(isset($_GET['id']))
                {
                    $ISBN = $_GET['id'];
                    $sql3 = "SELECT * FROM tbl_book WHERE ISBN = '$ISBN' ";
                    $res3 = mysqli_query($link, $sql3);

                    if(mysqli_num_rows($res3)==1)
                    {
                        $row = mysqli_fetch_assoc($res3);
                        $title = $row['book_title'];
                        $category = $row['book_category'];
                        $edition = $row['book_edition'];
                        $author = $row['book_author'];
                        $publisher = $row['book_publisher'];
                        $pub_date = $row['pub_date'];
                        $key = $row['book_keyword'];
                        $desc = $row['book_description'];
                        $prev_img = $row['book_image'];
                        $quantity = $row['book_quantity'];
                        $prevquantity = $row['book_quantity'];
                    }
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="add-book-table1">
                    <table>
                        <tr>
                            <td>ISBN : </td>
                            <td>
                                <input type="number" name="ISBN" placeholder="Enter Number" value="<?php echo $ISBN; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Title : </td>
                            <td>
                                <input type="text" name="title" placeholder="Book Title" value="<?php echo $title; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Select Image : </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <td>Category : </td>
                            <td>
                                <input type="text" name="category" placeholder="Book Category" value="<?php echo $category; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Edition : </td>
                            <td>
                                <input type="text" name="edition" placeholder="Book Edition" value="<?php echo $edition; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Author : </td>
                            <td>
                                <input type="text" name="author" placeholder="Book Author" value="<?php echo $author; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Publisher : </td>
                            <td>
                                <input type="text" name="publisher" placeholder="Book Publisher" value="<?php echo $publisher; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Publication Date : </td>
                            <td>
                                <input type="number" name="pub_date" placeholder="Enter Year" pattern="[0-9]{4}" value="<?php echo $pub_date; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>
                                <input type="number" name="quantity" placeholder="Enter Book Quantity" value="<?php echo $quantity; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="prev_img" value="<?php echo $prev_img; ?>"></td>
                        </tr>
                    </table>
                </div>    
                <div class="add-book-table2"> 
                    <table>
                        <tr>
                            <td>
                                Keyword :
                                <input type="text" name="key" placeholder="Enter Keyword" value="<?php echo $key; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding: 4px 0px 13px 0px;">Description :</p>    
                                <textarea name="desc" rows="10" cols="30" placeholder="Enter Book Description"><?php echo $desc; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 55px;">
                                <input type="submit" name="add" value="Update Book Record" class="btn-add-book-record">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>

            <?php
                if(isset($_POST['add']))
                {
                    $title = $_POST['title'];
                    $category = $_POST['category'];
                    $edition = $_POST['edition'];
                    $author = $_POST['author'];
                    $publisher = $_POST['publisher'];
                    $pub_date = $_POST['pub_date'];
                    $quantity = $_POST['quantity'];
                    $key = $_POST['key'];
                    $img = $_POST['prev_img'];

                    if(isset($_POST['desc']))
                    {
                        $desc = $_POST['desc'];
                    }

                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];
                            
                        if($image_name != "")
                        {
                            $ext = end(explode('.', $image_name));
                            $image_name = "ISBN_".$ISBN.'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../IMAGES/BOOKS/".$image_name;
                        }
                        else
                        {
                            $image_name = $img;
                        }
                    }

                    $sql1 = "UPDATE tbl_book 
                            SET book_title=('$title'), book_category=('$category'), book_edition=('$edition'), 
                                book_author=('$author'), book_publisher=('$publisher'), pub_date=('$pub_date'), 
                                book_keyword=('$key'), book_description=('$desc'), book_image=('$image_name'), book_quantity=($quantity)
                            WHERE ISBN = '$ISBN' ";
                    $res1 = mysqli_query($link, $sql1);

                    if($res1==true)
                    {
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        if($quantity > $prevquantity)
                        {
                            for($i=$prevquantity; $i<$quantity; $i++)
                            {
                                $no = $i+1;
                                $sql2 = "INSERT INTO tbl_bookcopy (ISBN, copy_no, book_status)
                                        VALUES (('$ISBN'), ($no), ('Available'))";
                                $res2 = mysqli_query($link, $sql2);
                            }
                        }
                        else if($quantity < $prevquantity)
                        {
                            for($i=$quantity; $i<$prevquantity; $i++)
                            {
                                $no = $i+1;
                                $sql2 = "DELETE FROM tbl_bookcopy WHERE ISBN='$ISBN' AND copy_no=$no ";
                                $res2 = mysqli_query($link, $sql2);
                            }
                        }
                        else if($quantity == $prevquantity)
                        {
                            for($i=0; $i<$quantity; $i++)
                            {
                                $no = $i+1;
                                $sql2 = "UPDATE tbl_bookcopy 
                                        SET copy_no=($no), book_status=('Available') WHERE ISBN=('$ISBN') AND copy_no=($no) ";
                                $res2 = mysqli_query($link, $sql2);
                            }
                        }

                        if($res2==true)
                        {
                            if($upload==false)
                            {
                                ?>
                                    <script type="text/javascript">
                                        alert("Failed to upload image file.");
                                    </script>
                                <?php
                            }
                            
                            ?>
                                <script type="text/javascript">
                                    alert("Book record successfully updated.");
                                    window.location="books.php";
                                </script>
                            <?php
                        }
                        else
                        {
                            ?>
                                <script type="text/javascript">
                                    alert("Failed to update book record.");
                                    window.location="books.php";
                                </script>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Failed to update book record.");
                                window.location="books.php";
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