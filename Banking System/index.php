<!DOCTYPE html>
<html lang ="en">

<head>
    <meta charset="UTF-8">
    <title>Basic Banking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="css_art.css" type="text/css">
</head>

<body id="home_page">

    <ul id="navbar">
        <li style="float: left; padding: 14px 80px; font-size: 26px;"><b>TSF Bank</b></li>
        <li><a href="transaction_history.php">Transaction History</a></li>
        <li><a href="view_all_customers.php">View All Customers</a></li>
        <li><a href="index.php">Home</a></li>
    </ul>

    <form class = "home-page" method = "post" action = "transfer_money.php">
        <p class="heading">We Find Ways</p>
        <button class="button_transfer button button_transfer1" name="transfer" value=NULL>Transfer</button>

        <!--CSS Art -->
        <div class = "piggy-bank-set">
            <div class= "coin">
                <div class = "dollar-sign">$</div>
            </div>

            <div class="piggy-bank">
                <div class = "piggy-body">
                    <div class="right-eye"></div>
                    <div class="left-eye"></div>
                    <div class = "nose-shadow"></div>
                    <div class = "nose">
                        <div class = "right-hole"></div>
                        <div class = "left-hole"></div>
                    </div>
                    <div class = "right-ear"></div>
                    <div class = "left-ear"></div>
                    <div class = "coin-hole"></div>
                </div>
            </div>
        </div>
    </form>

    <footer>
        <p id="footer">Copyright 
        <span>&#169;</span>
        2021
        by Jacqueline Ann Lim</p>
    </footer>

</body>
</html>