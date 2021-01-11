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
<body id = "transfer_money_page">

<ul id="navbar">
    <li style="float: left; padding: 14px 80px; font-size: 26px;"><b>TSF Bank</b></li>
    <li><a href="transaction_history.php">Transaction History</a></li>
    <li><a href="view_all_customers.php">View All Customers</a></li>
    <li><a href="index.php">Home</a></li>
</ul>

<form id = "transfer_money_form" method = "POST">
    <div id = "select_sender">
        <label for="sender">Sender: </label>
        <select name="sender" id="sender" onchange="disabledSelectedOption()">
            <option value=0 selected disabled>Select</option>
            <?php
                $sql = "SELECT * FROM customer_details;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $customerID = $row['cust_id'];
                        $customerName = $row['cust_name'];
                        $sender_current_balance = $row['acct_balance'];

                        if($_POST["transfer"] != NULL)
                        {
                            if($row['cust_id'] == $_POST["transfer"])
                            {
                                echo '<option value='.$customerID.' selected>'.$customerName.'</option>';
                            }

                            else
                            {
                                echo '<option value='.$customerID.'>'.$customerName.'</option>';
                            }
                        }
                    }
                }
            ?>
        </select>
    </div>

    <div id = "select_receiver">
        <label for="receiver">Recipient: </label>
        <select name="receiver" id="receiver">
            <option selected disabled>Select</option>
            <?php
                $sql = "SELECT * FROM customer_details;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $customerID = $row['cust_id'];
                        $customerName = $row['cust_name'];

                        echo '<option value='.$customerID.'>'.$customerName.'</option>';
                    }
                }
            ?>
        </select>
    </div>

    <div id = "input_amount">
        <label for="amount">Amount: </label>
        <input type="number" id="amount" name="amount" min="0" step="0.01" oninput="validity.valid||(value='');">
    </div>

    <div id = "transfer_now_button">
        <button class = "button_transfer button" name = "transfer" type="submit" onclick="checkDetails()" value=NULL>Transfer Now</button>
    </div>
</form>

<script>
disabledSelectedOption(); //calls the function immediately

function disabledSelectedOption() 
{
  var sender = document.getElementById("sender").value;
  var receiver = document.getElementById("receiver").getElementsByTagName("option");
  
  document.getElementById("receiver").disabled = false;
  if(sender == 0)
  {
      document.getElementById("receiver").disabled = true;
  }

  for (var i = 1; i < receiver.length; i++) 
  {
    receiver[i].disabled = false;

    if (receiver[i].value == sender) 
    {
        receiver[i].disabled = true;
    }
  }
}

function checkDetails() {
  var sender = document.getElementById("sender").value;
  var receiver = document.getElementById("receiver").value;
  var balance = parseFloat("<?php echo $sender_current_balance;?>");
  var amount = parseFloat(document.getElementById("amount").value);

  if(sender > 0 && receiver > 0 && balance >= amount){
    confirm("Transaction Successful!");
    document.getElementById("transfer_money_form").action = "transaction_history.php";
  }
  else if (sender > 0 && receiver > 0){
    alert("Transaction Failed. Insufficient Balance.")
    document.getElementById("transfer_money_form").action = "transfer_money.php";  
  }
  else{
    alert("Transaction Failed. Incomplete Details.")
    document.getElementById("transfer_money_form").action = "transfer_money.php";   
  }
}
</script>

</body>
</html>