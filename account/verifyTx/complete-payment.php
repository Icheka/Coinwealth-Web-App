<?php
error_reporting(0);
@session_start();

if (!isset($_SESSION['username'])){
    header("Location: ../login/index.php");
}

/*
* Get user info for fields 
*/
$first = $_SESSION['firstname'];
$last = $_SESSION['lastname'];
$email = $_SESSION['email'];
$mobile = $_SESSION['mobile'];
$username = $_SESSION['username'];
$active_dep = $_SESSION['active_deposit'];
$active_curr_amount = $_SESSION['active_curr_amount'];
$active_currency = $_SESSION['active_currency'];
$roi = $_SESSION['current_revenue'];
$coin = $_SESSION['active_currency'];
$profit = $_SESSION['active_profit'];
$last_dep = $_SESSION['last_dep'];
$total_dep = $_SESSION['total_dep'];
$last_with = $_SESSION['last_with'];
$total_with = $_SESSION['total_with'];
$profit_earned = $_SESSION['profit_earned'];
$kyc = $_SESSION['kyc'];

/*..
* Return current values for BTC, ETH and LTC from the Blockchain API
..*/
require_once("../blockchain.php");

if (!isset($_SESSION['mode_of_payment'])){
    header("Location: ../invest/");
} else {
    if ($_SESSION['mode_of_payment'] == "BTC"){
        $mode = "BTC";
        $mode_img = "../../static/assets/img/exchange.gif";
        $api_array_index = 0;
        $min = 0.0042;
        $wallet_addr = "ADD WALLET ADDRESS here";
    } elseif ($_SESSION['mode_of_payment'] == "ETH"){
        $mode = "ETH";
        $mode_img = "../../static/assets/img/exchange.gif";
        $api_array_index = 1;
        $min = 0.1171;
        $wallet_addr = "ADD WALLET ADDRESS here";
    } elseif ($_SESSION['mode_of_payment'] == "LTC"){
        $mode = "LTC";
        $mode_img = "../../static/assets/img/exchange.gif";
        $api_array_index = 2;
        $min = 0.7745;
        $wallet_addr = "ADD WALLET ADDRESS here";
    }

    $amount = $_SESSION['investment_amount'];
    if ($amount > $min){
        $rate = $amount / $data[$api_array_index]["price"];
        $plan = $_SESSION['plan'];
    } else {
        $error[] = "You must invest at least " . $min . " " . $mode;
    }

}

?>
<!DOCTYPE html>
<html class="js" lang="en"><head>
	<meta charset="utf-8">
	<meta name="author" content="Ozuru, Icheka Fortune">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">

	<link rel="shortcut icon" href="../../static/plugins/img/favicon.png">

	<title>INVEST - COINWEALTH INVESTMENTS LIMITED</title>
	
	    <link rel="stylesheet" href="../../static/plugins/css/vendor.bundle.css">
	    <link rel="stylesheet" href="../../static/plugins/css/style.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../../static/assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../../static/assets/css/custom.css" type="text/css">
        <link rel="stylesheet" href="../../static/assets/css/theme.css" type="text/css">
        <link rel="stylesheet" href="../../static/plugins/css/themify/themify-icons.css">

</head>


<body class="user-dashboard">


    <div class="topbar">
        <div class="topbar-md d-lg-none">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="toggle-nav">
                             <div class="">                            
                                <img id="cheeseburger" style="width: 50%; height: 160%;" src="../../static/images/icons/alt_cheeseburger_icon.png" alt="" />
                            </div>
                            <!--
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                                                  -->
                    </a><!-- .toggle-nav -->

                    <div class="site-logo">
                        <a href="../" class="site-brand">
                            <img src="../../static/plugins/img/logo.png" alt="logo">
                        </a>
                    </div><!-- .site-logo -->

                    <div class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> <img class="icon" src="../../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-dropdown">
                                <div class="user-dropdown-head">
                                    <h6 class="user-dropdown-name"><?php echo $first . " " . $last ?> <span>(<?php echo $username ?>)</span></h6>
                                    <span class="user-dropdown-email"><?php echo $email ?></span>
                                </div>
                                <div class="user-dropdown-balance">
                                <h6>CURRENT PROFIT</h6>
                                    <h3>$<?php 
                                        echo (isset($profit_earned)) ? $profit_earned : "0.00";
                                    ?>
                                    </h3>
                                    <ul>
                                        <li>0.0 BTC</li>
                                        <li>0.0 ETH</li>
                                        <li>0.0 LTC</li>
                                    </ul>
                                </div>
                                
                                <ul class="user-dropdown-btns btn-grp guttar-10px">
                                    <li><a href="../kyc/" class="btn btn-xs btn-warning"
                                    <?php 
                                    if (isset($kyc) && ($kyc == "y")){
                                        echo "style='display: none;'";
                                    }
                                    ?>
                                    >KYC Pending</a>
                                    <?php 
                                        if (isset($kyc) && ($kyc == "y")){
                                            echo "<a class='btn btn-xs btn-success text-white'>KYC Approved</a>";
                                        }
                                    ?>
                                </li>
                                </ul>
                                
                                <div class="gaps-1x"></div>
                                <ul class="user-dropdown-links">
                                    <li><a href="../edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
                                    <li><a href="../security/"><i class="ti ti-lock"></i>Security</a></li>
                                    <li><a href="../activities/"><i class="ti ti-eye"></i>Activity Log</a></li>
                                </ul>
                                <ul class="user-dropdown-links">
                                    <li><a href="../logout"><i class="ti ti-power-off"></i>Logout</a></li>
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
                        <a href="../" class="site-brand">
                            <img src="../../static/plugins/img/logo.png" alt="logo">
                        </a>
                    </div><!-- .site-logo -->
                </div><!-- .topbar-lg -->

                <div class="topbar-action d-none d-lg-block">
                    <ul class="topbar-action-list">
                        <li class="topbar-action-item topbar-action-link">
                            <a href="/"><em class="ti ti-home"></em> Go to main site</a>
                        </li><!-- .topbar-action-item -->

                        <li class="dropdown topbar-action-item topbar-action-user">
                            <a href="#" data-toggle="dropdown"> <img class="icon" src="../../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown">
                                    <div class="user-dropdown-head">
                                        <h6 class="user-dropdown-name"><?php echo $first . " " . $last ?> <span>(<?php echo $username ?>)</span></h6>
                                        <span class="user-dropdown-email"><?php echo $email ?></span>
                                    </div>
                                    <div class="user-dropdown-balance">
                                    <h6>CURRENT PROFIT</h6>
                                    <h3>$<?php 
                                        echo (isset($profit_earned)) ? $profit_earned : "0.00";
                                    ?>
                                    </h3>
                                        <ul>
                                            <li>0.0 BTC</li>
                                            <li>0.0 ETH</li>
                                            <li>0.0 LTC</li>
                                        </ul>
                                    </div>
                                    <ul class="user-dropdown-links">
                                        <li><a href="../edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
                                        <li><a href="../security/"><i class="ti ti-lock"></i>Security</a></li>
                                        <li><a href="../activities/"><i class="ti ti-eye"></i>Activity Log</a></li>
                                    </ul>
                                    <ul class="user-dropdown-links">
                                        <li><a href="../logout"><i class="ti ti-power-off"></i>Logout</a></li>
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
                <div class="user-sidebar user-sidebar-mobile">
                    <div class="user-sidebar-overlay"></div>
                    <div class="user-box d-none d-lg-block">
                        <div class="user-image">
                            <img src="../../static/plugins/img/user-thumb-lg.png" alt="thumb">
                        </div>
                        <h6 class="user-name"><?php echo $first . " " . $last ?></h6>
                        <div class="user-uid">username: <span><?php echo $username ?></span></div>
                        
                        <ul class="btn-grp guttar-10px">
                            <li><a href="../kyc/" class="btn btn-xs btn-warning">KYC Pending</a></li>
                        </ul>
                        
                    </div><!-- .user-box -->
                    <ul class="user-icon-nav">
                        <li><a href="../"><em class="ti ti-dashboard"></em>Dashboard</a></li>
                        <li><a href="../kyc/"><em class="ti ti-files"></em>KYC Application</a></li>
                        <li><a href="../invest/"><em class="ti ti-plus"></em>Make Investment</a></li>
                        <li><a href="../withdraw/"><em class="ti ti-minus"></em>Request Withdrawal</a></li>
                        <li><a href="../transactions/"><em class="ti ti-control-shuffle"></em>Transactions</a></li>
                        <li><a href="../referrals/"><em class="ti ti-infinite"></em>Referral</a></li>
                        <li><a href="../wallet/"><em class="ti ti-wallet"></em>Wallet</a></li>
                        <li><a href="../edit/"><em class="ti ti-id-badge"></em>Edit Profile</a></li>
                        <li><a href="../security/"><em class="ti ti-lock"></em>Security</a></li>
                    </ul><!-- .user-icon-nav -->
                    <div class="user-sidebar-sap"></div><!-- .user-sidebar-sap -->
                    <ul class="user-nav">
                        <li><a href="../how-to-invest/">How to invest?</a></li>
                        <li><a href="../faq/">Faqs</a></li>
                        <li><a href="../../media/whitepaper/whitepaper_X1Zj8e2.pdf">Whitepaper</a></li>
                        <li>Contact Support<span>info@coinwealthfx.com</span></li>
                    </ul><!-- .user-nav -->
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

                
                		<h2 class="user-panel-title"><?php echo $mode ?> DEPOSIT</h2>
                		<p>Make Deposit to the wallet below.</p>
                        <div style=" padding-bottom:20pt;" class="center-block text-center">
                            
                            <span id="barcode" class="center-block text-center "><img src="../../static/assets/img/btc_qr.jpg" height="250px" width="250px" style="background-color:red;"></span><br>
                            
                            <div class="gaps-3x"></div>
                            <div class="refferal-info">
                                <span class="refferal-copy-feedback copy-feedback"></span>
                                
                                <input type="text" class="refferal-address" value="<?php echo $wallet_addr ?>" disabled="">
                                <button class="refferal-copy copy-clipboard" data-clipboard-text="<?php echo $wallet_addr ?>"><em class="ti ti-files"></em></button>
                                
                            </div><!-- .refferal-info --> <!-- @updated on v1.0.1 -->
                            <br>
                            <div class="gaps-1x"></div>
                            
                            <span id="waiting"><img src="<?php echo $mode_img ?>" style="max-width:150px; "><br><small id="notification">Awaiting Payment</small><br><span style="color:#DD971E;"><small><i class="fas fa-info-circle"></i> Deposit <?php echo $rate . " " . $mode ?> (equivalent of $<?php echo $amount ?>) to the wallet generated above, then verify this transaction to activate your <?php echo $plan ?> investment.</small></span></span>
                            
                            <br>
                            <br>
                            <center><a href="../verifyTx/" class="btn btn-primary payment-btn">Verify Transaction</a></center>
                        </div>
                


                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
    


            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- UserWraper End -->


    <div class="footer-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <span class="footer-copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">Coinwealth Investments Limited</a>.<br>All Rights Reserved.</span>
                </div><!-- .col -->
                <div class="col-md-5 text-md-right">
                    <ul class="footer-links">
                        <li><a href="../policy/">Privacy Policy</a></li>
                        <li><a href="../terms-of-service/">Terms of Service</a></li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- FooterBar End -->


	<!-- JavaScript (include all script here) -->
	<script src="../../static/plugins/js/jquery.bundle.js"></script>
	<script src="../../static/plugins/js/script.js"></script>


</body></html>