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
    <title>Registration</title>
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
                    <li><a href="user_login.php"><i class="fa fa-sign-in" style="color: violet;"></i>&nbsp&nbspUSER_LOGIN</a></li>
                    <li><a href=""><i class="fa fa-thumbs-up" style="color: violet;"></i>&nbsp&nbspFEEDBACK</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <div class="sec_img" style="background-image: url(IMAGES/5.png);">
                <br>
                <div class="box3">
                    <form action="USER/registration.php" method="POST">
                        <p class="ur-text">REGISTRATION</p>
                        <div class="ur-input">
                            <p class="inpt_lbl">ID Number : </p>
                            <input type="text" name="user-id" placeholder="00-00000" pattern="[0-9]{2}[-]{1}[0-9]{5}" maxlength="8" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">First Name : </p>
                            <input type="text" name="user-fn" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Middle Name : </p>
                            <input type="text" name="user-mn" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Last Name : </p>
                            <input type="text" name="user-ln" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Gender : </p>
                            <select name="user-gender">
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Birth Date : </p>
                            <input type="date" name="user-dob" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">User Type : </p>
                            <select name="user-type">
                                <option value="STUDENT">STUDENT</option>
                                <option value="TEACHER">TEACHER</option>
                            </select>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Email : </p>
                            <input type="email" name="user-email" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Password : </p>
                            <input type="password" name="user-password" required>
                        </div>
                        <div class="ur-input">
                            <p class="inpt_lbl">Confirm Password : </p>
                            <input type="password" name="confirm-password" required>
                        </div>
                        <div class="ur-input">
                            <button name="submit" class="btn" style="font-weight: bold;">CREATE ACCOUNT</button>
                        </div>
                        <p class="login-register-text" style="font-size: 18px;">Already have an account? <a href="user_login.php">Sign In Here.</a></p>
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