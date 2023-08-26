<?php
error_reporting(0);
@session_start();

require_once("../../../trash.php");
require_once("../../../sanitize.php");


if (!isset($_SESSION['admin'])){
    header("Location: login.php");
}
$id = $_SESSION['id'];

$sql = "SELECT * FROM admins_info WHERE unique_id = '$id'";
$resource = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
    $_SESSION['first'] = $row['firstname'];
    $_SESSION['last'] = $row['lastname'];
    $_SESSION['email'] = $row['email'];
}
$first = $_SESSION['first'];
$last = $_SESSION['last'];
$email = $_SESSION['email'];

if (mysqli_errno($conn)){
    die("Could not connect to the database. <br /> Check your network connection or contact Fortune if this problem persists.");  
} 

if (isset($_POST['sn'])) {
    $sn = $_POST['sn'];
    $currency_amount = $_POST['currency_amount'];

    $sql = "UPDATE withdrawal_requests SET cashed = 'y' WHERE sn = '$sn'";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM withdrawal_requests WHERE sn = '$sn'";
    $resource = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $id = $row['unique_id'];
        $amount = $row['amount'];
        $currency = $row['payout_currency'];
        $wallet = $row['wallet'];
    }
    $sql = "INSERT INTO withdrawals (unique_id, withdrawal_amount, currency, withdrawal_date, currency_amount) VALUES ('$id', '$amount', '$currency', NOW(), '$currency_amount')";
    $result = mysqli_query($conn, $sql);

    $success = "Updated records successfully!";
}

?>
<!DOCTYPE html>
<html class="js" lang="en"><head>
	<meta charset="utf-8">
	<meta name="author" content="Ozuru, Icheka Fortune">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">

	<link rel="shortcut icon" href="../static/plugins/img/favicon.png">

	<title>ADMIN DASHBOARD - COINWEALTH INVESTMENTS LIMITED</title>
	
	    <link rel="stylesheet" href="../../../static/plugins/css/vendor.bundle.css">
	    <link rel="stylesheet" href="../../../static/plugins/css/style.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../../../static/assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../../../static/assets/css/custom.css" type="text/css">
        <link rel="stylesheet" href="../../../static/assets/css/theme.css" type="text/css">
        <link rel="stylesheet" href="../../../static/plugins/css/themify/themify-icons.css">

        <style>
            th {
                padding: 12px 6px !important;
            }
            td {
                padding: 8px 6px !important;
            }
            #success {
                width: 100%;
                border: 1px solid lightgreen;
                background: #efefef;
                border-radius: 4px;
                color: green;
                font-size: 120%;
                padding: 1em;
            }
        </style>

</head>

<body class="user-dashboard no-touch">


    <div class="topbar">
        <div class="topbar-md d-lg-none">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="toggle-nav">
                        <div class="toggle-icon">
                            <div class="">                            
                                <img id="cheeseburger" style="width: 50%; height: 160%;" src="../../../static/images/icons/alt_cheeseburger_icon.png" alt="" />
                            </div>
                            <!--
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                                                  -->
                        </div>
                    </a><!-- .toggle-nav -->

                    <div class="site-logo">
                        <a href="index.php" class="site-brand">
                            <img src="../../../static/plugins/img/logo.png" alt="logo">
                        </a>
                    </div><!-- .site-logo -->

                    <div class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> <img class="icon" src="../../../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-dropdown">
                                <div class="user-dropdown-head">
                                    <h6 class="user-dropdown-name"><span><?php echo $first." ".$last ?></span></h6>
                                    <span class="user-dropdown-email"><?php echo $email ?></span>
                                </div>
                                <div class="user-dropdown-balance">
                                    <h6>ADMIN</h6>
                                    <h3>&nbsp;</h3>
                                    
                                </div>
                                
                                <div class="gaps-1x"></div>
                                <ul class="user-dropdown-links">
                                    <li><a href="./logout.php"><i class="ti ti-power-off"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .toggle-action -->
                </div><!-- .container -->
            </div><!-- .container -->
        </div><!-- .topbar-md -->
        <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="topbar-lg d-none d-lg-block">
                    <div class="site-logo">
                        <a href="./admin.php" class="site-brand">
                            <img src="../../../static/plugins/img/logo.png" alt="logo">
                        </a>
                    </div><!-- .site-logo -->
                </div><!-- .topbar-lg -->

                <div class="topbar-action d-none d-lg-block">
                    <ul class="topbar-action-list">
                        <li class="topbar-action-item topbar-action-link">
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Go to main site</a>
                        </li><!-- .topbar-action-item -->

                        <li class="dropdown topbar-action-item topbar-action-user">
                            <a href="#" data-toggle="dropdown"> <img class="icon" src="../../../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown">
                                <div class="user-dropdown-balance">
                                    <h6>ADMIN</h6>
                                    <h3>&nbsp;</h3>
                                </div>
                                    <div class="user-dropdown-head">
                                        <h6 class="user-dropdown-name"><?php echo $first." ".$last ?></h6>
                                        <span class="user-dropdown-email"><?php echo $email ?></span>
                                    </div>
                                    <ul class="user-dropdown-links">
                                        <li><a href="./logout.php"><i class="ti ti-power-off"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li><!-- .topbar-action-item -->
                    </ul><!-- .topbar-action-list -->
                </div><!-- .topbar-action -->
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- TopBar End -->


    <div class="user-wraper">
        <div class="container">
            <div class="d-flex">
                <div class="user-sidebar">
                    <div class="user-sidebar-overlay"></div>
                    <div class="user-box d-none d-lg-block">
                        <div class="user-image">
                            <img src="../../../static/plugins/img/user-thumb-lg.png" alt="thumb">
                        </div>
                        <h6 class="user-name"><?php echo $first." ".$last ?></h6>
                        
                    </div><!-- .user-box -->
                    <ul class="user-icon-nav">
                        <li class="active"><a href="approve-investment.php"><em class="ti ti-plus"></em>Approve Investment</a></li>
                        <li><a href="view-transactions.php"><em class="ti ti-control-shuffle"></em>View user's transactions</a></li>
                        <li><a href="view-information.php"><em class="ti ti-infinite"></em>View user's information</a></li>
                        <li><a href="all-investments.php"><em class="ti ti-wallet"></em>View All Investments</a></li>
                        <li><a href="view-payouts.php"><em class="ti ti-wallet"></em>View All Payouts</a></li>
                        <li><a href="delete-user.php"><em class="ti ti-id-badge"></em>Delete User</a></li>
                        <li><hr role="separator" /></li>
                        <li><a href="logout.php"><em class="fa fa-sign-out"></em>Logout</a></li>
                    </ul><!-- .user-icon-nav -->
                    <div class="user-sidebar-sap"></div><!-- .user-sidebar-sap -->
                    
                    <div class="d-lg-none">
                        <div class="user-sidebar-sap"></div>
                        <div class="gaps-1x"></div>
                        <ul class="topbar-action-list">
                            <li class="topbar-action-item topbar-action-link">
                                <a href="/"><em class="ti ti-home"></em> Go to main site</a>
                            </li><!-- .topbar-action-item -->
                        </ul><!-- .topbar-action-list -->
                    </div>
                </div><!-- .user-sidebar -->


    

                <div class="user-content">
                    <div class="user-panel">
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="tile-item tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <center>
                                    <h6 class="tile-title">WELCOME</h6>
                                    <h6>ADMIN</h6>
                                    <h6>WITHDRAWAL REQUESTS</h6>
                                    
                                    <h1 class="tile-info">
                                        <?php echo $first ?>
                                    </h1>
                                    </center>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                        <div class="info-card info-card-bordered">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <?php if (isset($success)) echo "<p id='success'> $success </p>"; ?>
                                    <!-- RESULTS -->
                                    <table class="table table-sm table-condensed table-striped table-hover">
                                        <tr>
                                            <thead>
                                                <th>SN</th><th>UNIQUE ID</th><th>CURRENCY</th><th>AMOUNT</th><th>WALLET ADDR.</th>
                                            </thead>
                                        <tr>
                                            <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM withdrawal_requests WHERE cashed <> 'y'";
                                                $resource = mysqli_query($conn, $sql);

                                                while ($rows = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
                                                    echo "<tr> <td>$rows[sn]</td><td>$rows[unique_id]</td><td>$rows[payout_currency]</td><td>$rows[amount]</td><td>$rows[wallet]</td> </tr>";
                                                }
                                            ?>
                                            </tbody>
                                    </table>
                                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                                <h5>If you have made a transfer for a withdrawal request, update the database here.</h5>
                                                <label>Serial number (from the table):</label> <br />
                                                <center>
                                                    <input class="form-control border col-3" type="number" name="sn" required="" />
                                                </center>
                                                <label>How much did you transfer in currency units?</label> <br />
                                                <center>
                                                    <input class="form-control border col-3" type="number" name="currency_amount" required="" />
                                                    <br />
                                                    <button type="submit" class="btn btn-success col-4">Update</button>
                                                </center>
                                    </form>
                                </div>
                            </div>
                        </div><!-- .info-card -->
                        <div class="gaps-3x">
                            SELECT OPERATIONS FROM THE MENU.
                        </div>

                        
                    </div><!-- .user-panel -->
                </div><!-- .user-content -->




            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- UserWraper End -->

	<!-- JavaScript (include all script here) -->
	<script src="../../../static/plugins/js/jquery.bundle.js"></script>
	<script src="../../../static/plugins/js/script.js"></script>

</body></html>