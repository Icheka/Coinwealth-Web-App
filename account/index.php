<?php
error_reporting(0);
@session_start();

if (!isset($_SESSION['username'])){
    header("Location: login/index.php");
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
//die($profit_earned);
$kyc = $_SESSION['kyc'];

?>
<!DOCTYPE html>
<html class="js" lang="en"><head>
	<meta charset="utf-8">
	<meta name="author" content="Ozuru, Icheka Fortune">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">

	<link rel="shortcut icon" href="../static/plugins/img/favicon.png">

	<title>DASHBOARD - COINWEALTH INVESTMENTS LIMITED</title>
	
	    <link rel="stylesheet" href="../static/plugins/css/vendor.bundle.css">
	    <link rel="stylesheet" href="../static/plugins/css/style.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../static/assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../static/assets/css/custom.css" type="text/css">
        <link rel="stylesheet" href="../static/assets/css/theme.css" type="text/css">
        <link rel="stylesheet" href="../static/plugins/css/themify/themify-icons.css">

</head>

<body class="user-dashboard no-touch">


    <div class="topbar">
        <div class="topbar-md d-lg-none">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="toggle-nav">
                        <div class="toggle-icon">
                            <div class="">                            
                                <img id="cheeseburger" style="width: 50%; height: 160%;" src="../static/images/icons/alt_cheeseburger_icon.png" alt="" />
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
                            <img src="../static/plugins/img/logo.png" alt="logo">
                        </a>
                    </div><!-- .site-logo -->

                    <div class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> <img class="icon" src="../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-dropdown">
                                <div class="user-dropdown-head">
                                    <h6 class="user-dropdown-name"><span><?php echo $first." ".$last ?></span> <span>(<?php echo $username ?>)</span></h6>
                                    <span class="user-dropdown-email"><?php echo $email ?></span>
                                </div>
                                <div class="user-dropdown-balance">
                                    <h6>PROFIT EARNED</h6>
                                    <h3>$<?php echo $profit_earned ?></h3>
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
                                    <li><a href="edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
                                    <li><a href="security/"><i class="ti ti-lock"></i>Security</a></li>
                                    <li><a href="activities/"><i class="ti ti-eye"></i>Activity Log</a></li>
                                </ul>
                                <ul class="user-dropdown-links">
                                    <li><a href="./logout"><i class="ti ti-power-off"></i>Logout</a></li>
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
                        <a href="../account/" class="site-brand">
                            <img src="../static/plugins/img/logo.png" alt="logo">
                        </a>
                    </div><!-- .site-logo -->
                </div><!-- .topbar-lg -->

                <div class="topbar-action d-none d-lg-block">
                    <ul class="topbar-action-list">
                        <li class="topbar-action-item topbar-action-link">
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Go to main site</a>
                        </li><!-- .topbar-action-item -->

                        <li class="dropdown topbar-action-item topbar-action-user">
                            <a href="#" data-toggle="dropdown"> <img class="icon" src="../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown">
                                    <div class="user-dropdown-head">
                                        <h6 class="user-dropdown-name"><?php echo $first." ".$last ?><span>(<?php echo $username ?>)</span></h6>
                                        <span class="user-dropdown-email"><?php echo $email ?></span>
                                    </div>
                                    <div class="user-dropdown-balance">
                                        <h6>PROFIT EARNED</h6>
                                        <h3>$<?php 
                                        if (isset($profit_earned)){
                                            echo $profit_earned;
                                        } else {
                                            echo "0.00";
                                        } ?>
                                        </h3>
                                        <ul>
                                            <li>0.0 BTC</li>
                                            <li>0.0 ETH</li>
                                            <li>0.0 LTC</li>
                                        </ul>
                                    </div>
                                    <ul class="user-dropdown-links">
                                        <li><a href="/account/edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
                                        <li><a href="/account/security/"><i class="ti ti-lock"></i>Security</a></li>
                                        <li><a href="/account/activities/"><i class="ti ti-eye"></i>Activity Log</a></li>
                                    </ul>
                                    <ul class="user-dropdown-links">
                                        <li><a href="./logout"><i class="ti ti-power-off"></i>Logout</a></li>
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
                            <img src="../static/plugins/img/user-thumb-lg.png" alt="thumb">
                        </div>
                        <h6 class="user-name"><?php echo $first." ".$last ?></h6>
                        <div class="user-uid">username: <span><?php echo $username ?></span></div>
                        
                        <ul class="btn-grp guttar-10px">
                            <li><a href="kyc/" class="btn btn-xs btn-warning"<?php 
                                    if (isset($kyc) && ($kyc == "y")){
                                        echo "style='display: none;'";
                                    }
                                    ?>>KYC Pending</a>
                                <?php 
                                        if (isset($kyc) && ($kyc == "y")){
                                            echo "<a class='btn btn-xs btn-success text-white'>KYC Approved</a>";
                                        }
                                    ?>    
                                </li>
                        </ul>
                        
                    </div><!-- .user-box -->
                    <ul class="user-icon-nav">
                        <li class="active"><a href="/account/"><em class="ti ti-dashboard"></em>Dashboard</a></li>
                        <li><a href="kyc/"<?php 
                                    if (isset($kyc) && ($kyc == "y")){
                                        echo "style='display: none;'";
                                    }
                                    ?>><em class="ti ti-files"></em>KYC Application</a>
                                    <?php 
                                        if (isset($kyc) && ($kyc == "y")){
                                            echo "<a><em class='ti ti-files'></em>KYC Approved</a>";
                                        }
                                    ?>    
                                </li>
                        <li><a href="../account/invest/index.php"><em class="ti ti-plus"></em>Make Investment</a></li>
                        <li><a href="withdraw/"><em class="ti ti-minus"></em>Request Withdrawal</a></li>
                        <li><a href="transactions/"><em class="ti ti-control-shuffle"></em>Transactions</a></li>
                        <li><a href="referrals/"><em class="ti ti-infinite"></em>Referral</a></li>
                        <li><a href="wallet/"><em class="ti ti-wallet"></em>Wallet</a></li>
                        <li><a href="edit/"><em class="ti ti-id-badge"></em>Edit Profile</a></li>
                        <li><a href="security/"><em class="ti ti-lock"></em>Security</a></li>
                    </ul><!-- .user-icon-nav -->
                    <div class="user-sidebar-sap"></div><!-- .user-sidebar-sap -->
                    <ul class="user-nav">
                        <li><a href="/account/how-to-invest/">How to invest?</a></li>
                        <li><a href="/account/faq/">Faqs</a></li>
                        <li><a href="/media/whitepaper/whitepaper_X1Zj8e2.pdf">Whitepaper</a></li>
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
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tile-item tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <center>
                                    <h6 class="tile-title">ACTIVE DEPOSIT</h6>
                                    
                                    <h1 class="tile-info">$<?php 
                                    if (isset($active_dep)){
                                    echo $active_dep;
                                    } else {
                                        echo "0.00";
                                    }
                                     ?></h1>
                                    
                                    <ul class="tile-list-inline">
                                        <li>0.0 BTC</li>
                                        <li>0.0 ETH</li>
                                        <li>0.0 LTC</li>
                                    </ul>
                                    </center>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-6">
                                <div class="tile-item tile-light">
                                    <div class="tile-bubbles"></div>
                                    <center>
                                        <h6 class="tile-title">PROFIT EARNED</h6>
                                        <h1 class="tile-info" style="color:#2b56f5;">$<?php 
                                        if (isset($profit_earned)){
                                            echo $profit_earned;
                                        } else {
                                            echo "0";
                                        }
                                        ?></h1>
                                        <ul class="tile-list-inline">
                                            <li style="color:#2b56f5;">0.0 BTC</li>
                                            <li style="color:#2b56f5;">0.0 ETH</li>
                                            <li style="color:#2b56f5;">0.0 LTC</li>
                                        </ul>
                                    </center>

                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                        <div class="info-card info-card-bordered">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <center>
                                    <div class="info-card-image">
                                        <img src="../static/plugins/img/vector-a.png" alt="vector">
                                    </div>
                                    </center>
                                    <div class="gaps-2x d-md-none"></div>
                                </div>
                                <div class="col-sm-9">
                                    <h4>Thank you for joining over  100,000 financially-savy people in making the right decision concerning your money.</h4>
                                    <p>There are quick-access links to the left of this dashboard (if you're viewing the site on your desktop or iPad) or in the slide-in menu (if you're viewing on your smartphone).</p>
                                    <p>You can go make investments by following this link: <a href="../account/invest/">Make Investment</a> section.</p>
                                    <p>Get quick responses to any questions, and chat with the project in our Telegram: <a href="https://t.me/coinwealthfx">https://t.me/coinwealthfx</a></p>
                                    <p>There is also a live-chat option accessible by clicking the chat bubble.</p>
                                    <p>You can make more by inviting: each referral to our service earns you 10% referral bonus.</p>
                                    <div class="refferal-info">
                                        <span class="refferal-copy-feedback copy-feedback"></span>
                                        <em class="fas fa-link"></em>
                                        <input id="referral-address" class="refferal-address" value="" disabled="" type="text">
                                        <button class="refferal-copy copy-clipboard" data-clipboard-text="https://www.coinwealthfx.com/ref/Icheka"><em class="ti ti-files"></em></button>
                                    </div><!-- .refferal-info --> <!-- @updated on v1.0.1 -->
                                    <input type="hidden" id="served-username" value="<?php echo $username ?>" hidden="hidden">
                                    <script>
                                        document.getElementById("referral-address")
                                        .value = "https://www.coinwealthfx.com/ref/" +
                                        document.getElementById("served-username").value;
                                        
                                    </script>
                                </div>
                            </div>
                        </div><!-- .info-card -->
                        <div class="progress-card">
                            <h4>Active Investment Progress</h4>
                            <div class="gaps-1x"></div>
                            <div class="progress-bar">
                                <div class="progress-hcap" style="width:99.9999%">
                                    <div align="left">Final <br /> interest <span>$
                                        <?php 
                                            echo ($active_dep * ($profit/100));
                                        ?>
                                </span></div>
                                </div>
                                <div class="progress-percent" style="width:0%">
                                    
                                    <div align="right">ROI <br /> Earnings <span>$<?php echo (substr($profit_earned,0,6)) ?></span></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="gaps-3x"></div>
                        <div class="gaps-1x"></div>
                        <h4>Financial Statistics</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Active Deposit</th>
                                        <th>Last Deposit</th>
                                        <th>Total Investment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$<?php if(isset($active_dep)){
                                             echo $active_dep;
                                        } else {
                                            echo "0";
                                        }
                                             ?></td>
                                        <td>$<?php
                                        if (isset($last_dep)){
                                            echo $last_dep;
                                        } else {
                                            echo "0";
                                        }
                                         ?></td>
                                        <td>$<?php if(isset($total_dep)){
                                             echo $total_dep;
                                         } else {
                                             echo "0";
                                         } ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="gaps-3x"></div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Interest Earned</th>
                                        <th>Last Withdrawal</th>
                                        <th>Total Withdrawal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$<?php if(isset($roi)){
                                             echo $roi;
                                         } else {
                                             echo "0";
                                         } ?></td>
                                        <td>$<?php if(isset($last_with)){
                                             echo $last_with;
                                         } else {
                                             echo "0";
                                         } ?></td>
                                        <td>$<?php if(isset($total_with)){
                                             echo $total_with;
                                         } else {
                                             echo "0";
                                         } ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-home fa-2x"></i></td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <span class="footer-copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script>, <a href="#">Coinwealth Investments Limited</a>.<br>All Rights Reserved.</span>
                </div><!-- .col -->
                <div class="col-md-5 text-md-right">
                    <ul class="footer-links">
                        <li><a href="/account/policy/">Privacy Policy</a></li>
                        <li><a href="/account/terms-of-service/">Terms of Service</a></li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- FooterBar End -->


	<!-- JavaScript (include all script here) -->
	<script src="../static/plugins/js/jquery.bundle.js"></script>
	<script src="../static/plugins/js/script.js"></script>

    <script>
        setInterval(()=> {
            window.location.href="../collect.php";
        },
        360000);
    </script>

</body></html>