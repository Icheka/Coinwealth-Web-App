<?php
error_reporting(0);
session_start();

require_once("trash.php");

if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    /*...
    * BASIC INFORMATION ABOUT USER
    ...*/
    $sql = "SELECT * FROM clients_info WHERE username='$username'";
    $resource = mysqli_query($conn, $sql);

    while ($fields = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $_SESSION['firstname'] = $fields['firstname'];
        $_SESSION['lastname'] = $fields['lastname'];
        $_SESSION['middlename'] = $fields['middlename'];
        $_SESSION['email'] = $fields['email'];
        $_SESSION['mobile'] = $fields['mobile'];
        $_SESSION['username'] = $fields['username'];
        $_SESSION['country'] = $fields['country'];
        $_SESSION['unique_id'] = $fields['unique_id'];
        $_SESSION['kyc'] = $fields['kyc'];
    }
    $unique_id = $_SESSION['unique_id'];

    /*...
    * CURRENT EXCHANGE VALUES
    ...*/
    $sql = "SELECT btc_exchange, eth_exchange, ltc_exchange FROM admin_panel";
    $resource = mysqli_query($conn, $sql);
    while ($values = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $_SESSION['btc_exchange'] = $values['btc_exchange'];
        $_SESSION['eth_exchange'] = $values['eth_exchange'];
        $_SESSION['ltc_exchange'] = $values['ltc_exchange'];
    }
    $resource = NULL;

    /*...
    * ACTIVE DEPOSIT
    ...*/
    $sql = "SELECT * FROM investments WHERE unique_id = '$unique_id' ORDER BY deposit_date DESC LIMIT 1";
    $resource = mysqli_query($conn, $sql);

    while ($records = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $_SESSION['active_deposit'] = $records['deposit_amount'];
        $_SESSION['active_currency'] = $records['currency'];
        $_SESSION['active_plan'] = $records['deposit_plan'];
        $_SESSION['active_cashed'] = $records['cashed'];
        $_SESSION['active_date'] = $records['deposit_date'];
        $_SESSION['active_curr_amount'] = $records['currency_amount'];
        $_SESSION['active_profit'] = $records['profit'];
    }

    /*...
    * CURRENT PROFIT
    ...*/
    $today = time();
    $active_date = strtotime($_SESSION['active_date']);
    $temp_profit = $_SESSION['active_profit'];
    $temp_deposit = $_SESSION['active_deposit'];
    $temp_roi = (($temp_profit/100) * $temp_deposit);
    $_SESSION['current_revenue'] = $temp_roi;

    /*...
    * LAST DEPOSIT
    ...*/
    $sql = "SELECT deposit_amount FROM investments WHERE unique_id = '$unique_id' ORDER BY deposit_date DESC LIMIT 2";
    $resource = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $_SESSION['last_dep'] = $rows['deposit_amount'];
    }
    /*...
    * TOTAL DEPOSITS
    ...*/
    $sql = "SELECT deposit_amount FROM investments WHERE unique_id = '$unique_id' ORDER BY deposit_date DESC";
    $resource = mysqli_query($conn, $sql);
    $total = 0; //initialize total
    while ($deposits = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $total += $deposits['deposit_amount'];
    }
    //set total to session
    $_SESSION['total_dep'] = $total;

    /*...
    * LAST WITHDRAWAL
    ...*/
    $sql = "SELECT withdrawal_amount FROM withdrawals WHERE unique_id = '$unique_id' ORDER BY withdrawal_date DESC LIMIT 2";
    $resource = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $_SESSION['last_with'] = $rows['withdrawal_amount'];
    }
    $resource = mysqli_query($conn, $sql);
    
    /*...
    * TOTAL WITHDRAWALS
    ...*/
    $sql = "SELECT withdrawal_amount FROM withdrawals WHERE unique_id = '$unique_id' ORDER BY withdrawal_date DESC";
    $resource = mysqli_query($conn, $sql);
    $total = 0; //initialize total
    while ($withdrawals = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $total += $withdrawals['withdrawal_amount'];
    }
    //set total to session
    $_SESSION['total_with'] = $total;

    /*...
    * PROFIT EARNED
    * time_diff is time difference in days
    * (profit_earned = total_profit / 30) * time_diff
    ...*/
    $today = time();
    $active_date = strtotime($_SESSION['active_date']);
    $time_diff = ($today - $active_date)/86400;
    $curr_revenue = $_SESSION['current_revenue'];
    $profit_earned = ($curr_revenue/30) * $time_diff;
    $_SESSION['profit_earned'] = $profit_earned;

    
    header("Location: account/index.php");
} else {
    header("Location: account/login/index.php");
}



?>