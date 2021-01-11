<?php
    include_once 'database/connect.php';

    if(array_key_exists('sender', $_POST))
    {
        if($_POST["sender"] != NULL && $_POST["receiver"] != NULL && $_POST["amount"] != NULL)
        {
            $sql = "SELECT * FROM customer_details;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck > 0)
            {
                $sender_id = $_POST["sender"];
                $receiver_id = $_POST["receiver"];
                $amount = $_POST["amount"];
                $sender_customer_ID = intval($sender_id);
                $receiver_customer_ID = intval($receiver_id);

                while ($row = mysqli_fetch_assoc($result))
                {
                    if($row['cust_id'] == $sender_id)
                    {
                        $sender_name = $row['cust_name'];
                        $sender_updated_balance = floatval($row['acct_balance']) - floatval($amount);

                        $sql_select = "SELECT cust_name FROM customer_details WHERE cust_id = $receiver_customer_ID;";
                        $result_select = mysqli_query($conn, $sql_select);
                        while($row = mysqli_fetch_assoc($result_select))
                        {
                            $receiver_name = $row['cust_name'];
                        }

                        $sql_insert = "INSERT INTO transfer_history (transaction_id, sender_name, receiver_name, transferred_amount, transaction_date) VALUES (NULL, '$sender_name', '$receiver_name', '$amount', current_timestamp());";
                        mysqli_query($conn, $sql_insert);

                        $sql_update = "UPDATE customer_details SET acct_balance = $sender_updated_balance WHERE cust_id = $sender_customer_ID;";
                        mysqli_query($conn, $sql_update);
                    }

                    else if($row['cust_id'] == $receiver_id)
                    {
                        $receiver_updated_balance = floatval($row['acct_balance']) + floatval($amount);

                        $sql_update = "UPDATE customer_details SET acct_balance = $receiver_updated_balance WHERE cust_id = $receiver_customer_ID;";
                        mysqli_query($conn, $sql_update);
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic Banking System</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body id = "transaction_history_page">

<ul id="navbar">
    <li style="float: left; padding: 14px 80px; font-size: 26px;"><b>TSF Bank</b></li>
    <li><a href="transaction_history.php">Transaction History</a></li>
    <li><a href="view_all_customers.php">View All Customers</a></li>
    <li><a href="index.php">Home</a></li>
</ul>

<table id = "transfer_history">
    <tr>
        <th>Transaction ID</th>
        <th>Sender</th> 
        <th>Recipient</th>
        <th>Amount</th> 
        <th>Transaction Date</th>
    </tr>
<?php
    $sql = "SELECT * FROM transfer_history;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $transaction_id = $row['transaction_id'];
            $sender_name = $row['sender_name'];
            $receiver_name = $row['receiver_name'];
            $amount = $row['transferred_amount'];
            $transaction_date = $row['transaction_date'];
    
            echo '<tr> 
                    <td>'.$transaction_id.'</td> 
                    <td>'.$sender_name.'</td> 
                    <td>'.$receiver_name.'</td> 
                    <td>$'.$amount.'</td>    
                    <td>'.$transaction_date.'</td>                
                </tr> 
                <br>';
        }
    }
?>
</table>

</body>
</html>