<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>User - Log In</title>
</head>
<body>
    <div  class="wrapper">
        <header>
            <div class="lms_logo">
                <img src="IMAGES/1.png">
                <h1 style="color: lightblue; font-family: 'Times New Roman';">LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fa fa-home" style="color: violet;"></i>&nbsp&nbspHOME</a></li>
                    <li><a href=""><i class="fa fa-book" style="color: violet;"></i>&nbsp&nbspBOOKS</a></li>
                    <li><a href="admin_login.php"><i class="fa fa-sign-in" style="color: violet;"></i>&nbsp&nbspADMIN_LOGIN</a></li>
                    <li><a href="user_registration.php"><i class="fa fa-user-plus" style="color: violet;"></i>&nbsp&nbspREGISTRATION</a></li>
                    <li><a href=""><i class="fa fa-thumbs-up" style="color: violet;"></i>&nbsp&nbspFEEDBACK</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <div class="sec_img" style="background-image: url(IMAGES/4.png);">
                <br>
                <div class="box2">

                    <form action="USER/login.php" method="POST">
                        <p class="ul-text">USER LOGIN</p>
                        <div class="ul-input">
                            <input type="email" placeholder="USERNAME" name="user-email" required>
                        </div>
                        <div class="ul-input">
                            <input type="password" placeholder="PASSWORD" name="user-password" required>
                        </div>
                        <div class="ul-input">
                            <button name="submit" class="btn">SIGN IN</button>
                        </div>
                        <p class="login-register-text" style="font-size: 18px;">Don't have an account? <a href="user_registration.php">Register Here.</a></p>
                    </form>
                    
                </div>
            </div>
        </section>
        <footer>
            <br>
            <div class="sm">
                <i class='fa fa-facebook'></i>&nbsp&nbsp&nbsp&nbsp&nbsp
                <i class='fa fa-twitter'></i>&nbsp&nbsp&nbsp&nbsp&nbsp
                <i class='fa fa-google'></i>&nbsp&nbsp&nbsp&nbsp&nbsp
                <i class='fa fa-yahoo'></i>&nbsp&nbsp&nbsp&nbsp&nbsp
                <i class='fa fa-instagram'></i><br>
            </div>
            <br>
            <div>
                <p style="font-family: 'Times New Roman'; text-align: center; color: white; padding-top: 5px;">
                    Copyright &copy; 2022 Library Management System<br>
                    Designed by BS in Computer Science Major in Software Development Students<br>
                    <i class='fa fa-phone-square'></i>&nbsp&nbsp<a href="tel:+639686812424">09686812424</a><br>
                    <i class='fa fa-envelope-square'></i>&nbsp&nbsp<a href="mailto:thrulx@gmail.com">bscs_lms@gmail.com</a></p>
                </p>
            </div>
        </footer>
    </div>
</body>
</html>