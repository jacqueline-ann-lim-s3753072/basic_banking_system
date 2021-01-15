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
<body id = "customer_profile_page">

    <!--Navigation bar -->
    <ul id="navbar">
        <li style="float: left; padding: 14px 80px; font-size: 26px;"><b>TSF Bank</b></li>
        <li><a href="transaction_history.php">Transaction History</a></li>
        <li><a href="view_all_customers.php">View All Customers</a></li>
        <li><a href="index.php">Home</a></li>
    </ul>

    <!--Select and view ONE customer's details -->
    <?php
        //the selected customer is based on the value of "view" from the form with the POST method (located in the "view_all_customers.php file) 
        //use customer id to select and identify a customer uniquely
        $selected_customer = intval($_POST["view"]); 
        $sql = "SELECT * FROM customer_details WHERE cust_id = $selected_customer;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        if($resultCheck > 0)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
    
                $customerID = $row['cust_id'];
                $customerName = $row['cust_name'];
                $email = $row['email'];
                $accountBalance = $row['acct_balance'];
        
                echo '<table id="customer_profile">
                        <tr>
                            <td><b>Customer ID</b></td>
                            <td>'.$customerID.'</td>
                        </tr>
                        <tr>
                            <td><b>Customer Name</b></td>
                            <td>'.$customerName.'</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>'.$email.'</td>
                        </tr>
                        <tr>
                            <td><b>Current Balance</b></td>
                            <td>$'.$accountBalance.'</td>
                        </tr>
                      </table>
                      <form method = "post" action = "transfer_money.php">
                        <button class="button_transfer button_transfer2 button" name="transfer" value='.$customerID.'>Transfer Money</button>
                      </form>
                      ';
                    //The value of the "transfer" button will be sent to "transfer_money.php" by means of 'method' and 'action' form attribute
            }
        }
    ?>

</body>
</html>
