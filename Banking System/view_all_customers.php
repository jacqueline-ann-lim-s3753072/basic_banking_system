<?php
    include_once 'database/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic Banking System</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body id = "view_all_customers_page">

    <!--Navigation bar -->
    <ul id="navbar">
        <li style="float: left; padding: 14px 80px; font-size: 26px;"><b>TSF Bank</b></li>
        <li><a href="transaction_history.php">Transaction History</a></li>
        <li><a href="view_all_customers.php">View All Customers</a></li>
        <li><a href="index.php">Home</a></li>
    </ul>

    <!--Table containing all customers' details -->
    <table id="customer_details">
        <!--Column Headings -->
        <tr>
            <th>Customer ID</th>
            <th>Name</th> 
            <th>Email</th>
            <th>Account Balance</th>
            <th></th>
        </tr>
    <!--Displaying the set of tuples from the database -->
    <?php
        $sql = "SELECT * FROM customer_details;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $customerID = $row['cust_id'];
                $customerName = $row['cust_name'];
                $email = $row['email'];
                $accountBalance = $row['acct_balance'];

                echo '<tr> 
                        <td>'.$customerID.'</td> 
                        <td>'.$customerName.'</td> 
                        <td>'.$email.'</td> 
                        <td>$'.$accountBalance.'</td>
                        <td><form method = "post" action = "customer_profile.php"><button class = "button_view button" name="view" value='.$customerID.'>View</button></form></td>                   
                    </tr> 
                    <br>';
                //The value of the "view" button will be sent to "customer_profile.php" by means of the 'method' and 'action' form attribute
            }
        }
    ?>
    </table>

</body>
</html>
