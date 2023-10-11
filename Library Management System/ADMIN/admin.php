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
    <title>Home</title>
</head>
<body>

    <header>
        <?php
            include('header.php');
        ?>
    </header>

    <section style="height: 600px;">

        <br>
        <div class="admin-dashboard-wrapper">

            <h1 class="text-admin-dashboard">Administrator Dashboard</h1>
            <br><br>

            <div class="container">

                <div class="box">
                    <?php 
                        $sql1 = "SELECT * FROM tbl_user";
                        $res1 = mysqli_query($link, $sql1);
                        $count1 = mysqli_num_rows($res1);
                    ?>
                    <h1 class="text-count"><?php echo $count1; ?></h1>
                    <br/>
                    Total Users
                </div>

                <div class="box">
                    <?php 
                        $sql2 = "SELECT * FROM tbl_bookcopy";
                        $res2 = mysqli_query($link, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1 class="text-count"><?php echo $count2; ?></h1>
                    <br/>
                    Books Total
                </div>

                <div class="box">
                    <?php 
                        $sql3 = "SELECT * FROM tbl_bookcopy WHERE book_status = 'Not Available' ";
                        $res3 = mysqli_query($link, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1 class="text-count"><?php echo $count3; ?></h1>
                    <br/>
                    Books In Use
                </div>

                <div class="box">
                    <?php 
                        $sql4 = "SELECT * FROM tbl_request WHERE req_status = 'PENDING' ";
                        $res4 = mysqli_query($link, $sql4);
                        $count4 = mysqli_num_rows($res4);
                    ?>
                    <h1 class="text-count"><?php echo $count4; ?></h1>
                    <br/>
                    Book Requests
                </div>

                <div class="box">
                    <?php 
                        $sql5 = "SELECT * FROM tbl_reservation WHERE res_status = 'PENDING' ";
                        $res5 = mysqli_query($link, $sql5);
                        $count5 = mysqli_num_rows($res5);
                    ?>
                    <h1 class="text-count"><?php echo $count5; ?></h1>
                    <br/>
                    Book Reservations
                </div>

                <div class="box">
                    <h1 class="text-count">10</h1>
                    <br/>
                    Book Reports
                </div>

            </div>

        </div>

    </section>

    <footer>
        <?php
            include('footer.php');
        ?>
    </footer>

</body>
</html>