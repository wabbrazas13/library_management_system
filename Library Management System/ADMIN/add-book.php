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
    <title>Add Book Record</title>
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
            <h1 class="text-add-book">Add Book Records</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="add-book-table1">
                    <table>
                        <tr>
                            <td>ISBN : </td>
                            <td>
                                <input type="number" name="ISBN" placeholder="Enter Number" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Title : </td>
                            <td>
                                <input type="text" name="title" placeholder="Book Title" required>
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
                                <input type="text" name="category" placeholder="Book Category" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Edition : </td>
                            <td>
                                <input type="text" name="edition" placeholder="Book Edition" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Author : </td>
                            <td>
                                <input type="text" name="author" placeholder="Book Author" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Publisher : </td>
                            <td>
                                <input type="text" name="publisher" placeholder="Book Publisher" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Publication Date : </td>
                            <td>
                                <input type="number" name="pub_date" placeholder="Enter Year" pattern="[0-9]{4}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>
                                <input type="number" name="quantity" placeholder="Enter Book Quantity" required>
                            </td>
                        </tr>
                    </table>
                </div>    
                <div class="add-book-table2"> 
                    <table>
                        <tr>
                            <td>
                                Keyword :
                                <input type="text" name="key" placeholder="Enter Keyword" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding: 4px 0px 13px 0px;">Description :</p>    
                                <textarea name="desc" rows="10" cols="30" placeholder="Enter Book Description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 70px;">
                                <input type="submit" name="add" value="Add Book Record" class="btn-add-book-record">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>

            <?php
                if(isset($_POST['add']))
                {
                    $ISBN = $_POST['ISBN'];
                    $title = $_POST['title'];
                    $category = $_POST['category'];
                    $edition = $_POST['edition'];
                    $author = $_POST['author'];
                    $publisher = $_POST['publisher'];
                    $pub_date = $_POST['pub_date'];
                    $quantity = $_POST['quantity'];
                    $key = $_POST['key'];
                    
                    if(isset($_POST['desc']))
                    {
                        $desc = $_POST['desc'];
                    }

                    $sql = "SELECT * FROM tbl_book WHERE ISBN = '$ISBN' ";
                    $res = mysqli_query($link, $sql);

                    if(mysqli_num_rows($res)>0)
                    {
                        ?>
                            <script type="text/javascript">
                                alert("ISBN <?php echo $ISBN; ?> is already recorded.");
                                window.location="books.php";
                            </script>
                        <?php
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
                    }
                    else
                    {
                        $image_name = "";
                    }

                    $sql1 = "INSERT INTO tbl_book (ISBN, book_title, book_category, book_edition, book_author, book_publisher, pub_date, book_keyword, book_description, book_image, book_quantity)
                            VALUES (('$ISBN'), ('$title'), ('$category'), ('$edition'), ('$author'), ('$publisher'), ('$pub_date'), ('$key'), ('$desc'), ('$image_name'), ($quantity))";
                    $res1 = mysqli_query($link, $sql1);

                    if($res1==true)
                    {
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        for($i = 0; $i < $quantity; $i++)
                        {
                            $no = $i + 1;
                            $sql2 = "INSERT INTO tbl_bookcopy (ISBN, copy_no, book_status)
                                    VALUES (('$ISBN'), ($no), ('Available'))";
                            $res2 = mysqli_query($link, $sql2);
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
                                    alert("Book record successfully added.");
                                    window.location="books.php";
                                </script>
                            <?php
                        }
                        else
                        {
                            ?>
                                <script type="text/javascript">
                                    alert("Failed to add book record!");
                                    window.location="add-book.php";
                                </script>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Failed to add book record!");
                                window.location="add-book.php";
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