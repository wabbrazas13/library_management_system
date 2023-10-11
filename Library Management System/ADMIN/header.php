<?php?>
    
<style>
    header{
        height: 60px;
        width: 1365px;
        background-color: black;
        color: skyblue;
        position: fixed;
    }
    .w3-bar .w3-bar-item {
        height: 60px;
    }
    .w3-bar .w3-bar-item h1 {
        font-size: 30px;
        padding-top: 5px;
    }
    .w3-bar .w3-bar-item a {
        text-decoration: none;
        font-size: 16px; 
    }  
</style>

<body>
    <header>
        <div class="w3-bar">
            <div class="w3-bar-item">
                <h1>LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
            <div class="w3-bar-item w3-hover-teal w3-padding-24">
                <a href="admin.php" title="Admin Home Page"><i class="fa fa-home"></i> HOME</a>
            </div>
            <div class="w3-bar-item w3-hover-teal w3-padding-24">
                <a href="books.php" title="Manage Books"><i class="fa fa-book"></i> BOOKS</a>
            </div>
            <div class="w3-bar-item w3-hover-teal w3-padding-24">
                <a href="" title="Manage Users"><i class="fa fa-users"></i> USERS</a>
            </div>
            <div class="w3-dropdown-hover">
                <button class="w3-button" style="font-size: 16px; height: 60px; padding-bottom: 3px;"><i class="fa fa-caret-down fa-lg"></i> TRANSACTIONS</button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="book-transaction.php" class="w3-bar-item w3-button" style="font-size: 15px; height: 30px;">BOOK TRANSACTIONS</a>
                    <a href="book-request.php" class="w3-bar-item w3-button" style="font-size: 15px; height: 30px;">BOOK REQUEST</a>
                    <a href="book-reservation.php" class="w3-bar-item w3-button" style="font-size: 15px; height: 30px;">BOOK RESERVATION</a>
                    <a href="" class="w3-bar-item w3-button" style="font-size: 15px; height: 30px;">BOOK REPORT</a>
                </div>
            </div>
            <div class="w3-bar-item w3-hover-teal w3-padding-24">
                <a href="" title="View Feedbacks"><i class="fa fa-thumbs-up"></i> FEEDBACK</a>
            </div>
        </div>
    </header>
</body>