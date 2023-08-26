<?php
error_reporting(0);
@session_start();

if (!isset($_SESSION['username'])){
    header("Location: ../login/");
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

?>
<!DOCTYPE html>
<html class="js" lang="en"><head>
	<meta charset="utf-8">
	<meta name="author" content="Softnio">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	
	<link rel="shortcut icon" href="../../static/plugins/img/favicon.png">
	
	<title>CHOOSE PLAN - COINWEALTH INVESTMENTS LIMITED</title>
	
	<link rel="stylesheet" href="../../static/plugins/css/vendor.bundle.css">
	<link rel="stylesheet" href="../../static/plugins/css/style.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../../static/assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../../static/assets/css/custom.css" type="text/css">
        <link rel="stylesheet" href="../../static/assets/css/theme.css" type="text/css">

</head>

<body class="user-dashboard no-touch">


    <div class="topbar">
        <div class="topbar-md d-lg-none">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="toggle-nav">
                        <div class="toggle-icon">
                            <div class="">                            
                                <img id="cheeseburger" style="width: 50%; height: 160%;" src="../../static/images/icons/alt_cheeseburger_icon.png" alt="" />
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
                        <a href="../account/" class="site-brand">
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
                                    <h6>CURRENT REVENUE</h6>
                                    <h3>$
                                        <?php
                                            echo (isset($profit_earned) ? substr($profit_earned, 0, 6) : "0");
                                        ?>
                                    </h3>
                                    <ul>
                                        <li>0.0 BTC</li>
                                        <li>0.0 ETH</li>
                                        <li>0.0 LTC</li>
                                    </ul>
                                </div>
                                
                                <ul class="user-dropdown-btns btn-grp guttar-10px">
                                    <li><a href="kyc/" class="btn btn-xs btn-warning"
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
                            <a href="/"><em class="fa fa-home"></em> Go to main site</a>
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
                                        <h6>PROFIT EARNED</h6>
                                        <h3>$
                                            <?php
                                            echo (isset($profit_earned) ? substr($profit_earned, 0, 6) : "0.00")
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
                <div class="user-sidebar">
                    <div class="user-sidebar-overlay"></div>
                    <div class="user-box d-none d-lg-block">
                        <div class="user-image">
                            <img src="../../static/plugins/img/user-thumb-lg.png" alt="thumb">
                        </div>
                        <h6 class="user-name"><?php echo $first . " " . $last ?></h6>
                        <div class="user-uid">username: <span><?php echo $username ?></span></div>
                        
                        <ul class="user-dropdown-btns btn-grp guttar-10px">
                                    <li><a href="kyc/" class="btn btn-xs btn-warning"
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
                        
                    </div><!-- .user-box -->
                    <ul class="user-icon-nav">
                        <li><a href="../"><em class="ti ti-dashboard"></em>Dashboard</a></li>
                        <li><a href="../kyc/"><em class="ti ti-files"></em>KYC Application</a></li>
                        <li class="active"><a href="../invest/"><em class="ti ti-plus"></em>Make Investment</a></li>
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
                        <li><a href="../../faq/">Faqs</a></li>
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
                        <h2 class="user-panel-title">Choose Investment Plan</h2>
                        <p>Choose your preferred investment plan to proceed.</p>
                        <div class="gaps-3x"></div>
                        <a href="../invest-basic/">
                        <div class="token-card">
                            <div class="token-info">
                                <span class="token-smartag">BASIC</span>
                                <h2 class="token-bonus">3% <span>daily ROI</span></h2>
                                <ul class="token-timeline">
                                    <li><span>DURATION</span>30 days</li>
                                    <li><span>MINIMUM</span>$50</li>
                                </ul>
                            </div>
                            <div class="token-countdown">
                                <span class="token-countdown-title">ROI FOR INVESTMENT DURATION</span>
                                <h2 class="token-bonus"><span>Minimum withdrawal</span> $5</h2>
                            </div>
                        </div><!-- .token-card -->
                        </a>
                        <a href="../invest-compound/">
                        <div class="token-card">
                            <div class="token-info">
                                <span class="token-smartag">COMPOUND</span>
                                <h2 class="token-bonus">5% <span>daily ROI</span></h2>
                                <ul class="token-timeline">
                                    <li><span>DURATION</span>30 days</li>
                                    <li><span>MINIMUM</span>$1000</li>
                                </ul>
                            </div>
                            <div class="token-countdown">
                                <span class="token-countdown-title">ROI FOR INVESTMENT DURATION</span>
                                <h2 class="token-bonus"><span>Minimum withdrawal</span> $100</h2>
                            </div>
                        </div><!-- .token-card -->
                        </a>
                        <a href="../invest-aggressive/">
                        <div class="token-card">
                            <div class="token-info">
                                <span class="token-smartag">AGGRESSIVE</span>
                                <h2 class="token-bonus">15% <span>daily ROI</span></h2>
                                <ul class="token-timeline">
                                    <li><span>DURATION</span>30 days</li>
                                    <li><span>MINIMUM</span>$5000</li>
                                </ul>
                            </div>
                            <div class="token-countdown">
                                <span class="token-countdown-title">ROI FOR INVESTMENT DURATION</span>
                                <h2 class="token-bonus"><span>Minimum withdrawal</span> $1000</h2>
                            </div>
                        </div><!-- .token-card -->
                        </a>
                        <div class="gaps-3x"></div>

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
                    <span class="footer-copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script>2020, <a href="#">Coinwealth Investments Limited</a>.<br>All Rights Reserved.</span>
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