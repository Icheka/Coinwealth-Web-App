<?php

error_reporting(0);
@session_start();

require_once("../../trash.php");
require_once("../../sanitize.php");

$new_pass2 = "jjjdd";
//echo strlen($new_pass2); die();

if (!isset($_SESSION['username'])){
    header("Location: login/index.php");
}

/*
* Get user info for fields 
*/
$unique_id = $_SESSION['unique_id'];

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

$finish = "no";
$not_exists = "false";
$errors = [];

if (isset($_POST['csrfmiddlewaretoken'])){
    $sql = "SELECT * FROM clients_info WHERE unique_id = '$unique_id'";
    $resource = mysqli_query($conn, $sql);
    while ($retrieved_password = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
        $real_pass = $retrieved_password['pass'];
    }
    
    /*..
    * Verify old password matches
    ..*/
    $old_pass = sanitize($_POST['old_password']);
    if (password_verify($old_pass, $real_pass)){
        $not_exists = "true";
    } else {
        $errors[] = "Your old password doesn't look right";
    }

    /*..
    * If $not_exists is true, continue
    ..*/
    if ($not_exists === "true"){
        //validate new passwords
        $new_pass1 = sanitize($_POST['new_password1']);
        $new_pass2 = sanitize($_POST['new_password2']);
        if ($new_pass1 === $new_pass2){
            if ((strlen($new_pass1) >= 8) && (strlen($new_pass2) >= 8)){
                $finish = "okay";
            } else {
                $errors[] = "Your passwords either don't match or they are less than 8 characters long or do not contain uppercase and numbers";
            }
        }
    }

    /*..
    * If $finish is 'okay'
    ..*/
    $new_pass = sanitize($_POST['new_password1']);
    $new_pass = password_hash($new_pass, PASSWORD_BCRYPT);
    if ($finish === "okay"){
        $sql = "UPDATE clients_info SET pass = '$new_pass' where unique_id = '$unique_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows){
            $success = "Your password was updated successfully";
        } else {
            $errors[] = "We could not update your password. Contact us at info@coinwealthfx.com for more information";
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en" class="js"><head>
	<meta charset="utf-8">
	<meta name="author" content="Softnio">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	
	<link rel="shortcut icon" href="../../static/plugins/img/favicon.png">
	
	<title>SECURITY - COINWEALTH INVESTMENTS LIMITED</title>
	
	<link rel="stylesheet" href="../../static/plugins/css/vendor.bundle.css">
	<link rel="stylesheet" href="../../static/plugins/css/style.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../static/assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../static/assets/css/custom.css" type="text/css">
    <link rel="stylesheet" href="../../static/assets/css/theme.css">
    <link rel="stylesheet" href="../../static/plugins/css/themify/themify-icons.css">

    <style>
        #errors {
            width: 100%;
            color: red;
            border: 2px solid red;
            border-radius: 6px;
            padding: 1em;
        }
        #success {
            width: 100%;
            color: green;
            border: 4px solid lightgreen;
            border-radius: 6px;
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
                                    <h6>CURRENT REVENUE</h6>
                                    <h3>$<?php
                                            if (isset($profit_earned)){
                                                echo $profit_earned;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?></h3>
                                    <ul>
                                        <li>0.0 BTC</li>
                                        <li>0.0 ETH</li>
                                        <li>0.0 LTC</li>
                                    </ul>
                                </div>
                                
                                <ul class="user-dropdown-btns btn-grp guttar-10px">
                                    <li><a href="../kyc/" class="btn btn-xs btn-warning">KYC Pending</a></li>
                                </ul>
                                
                                <div class="gaps-1x"></div>
                                <ul class="user-dropdown-links">
                                    <li><a href="../edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
                                    <li class="active"><a href="../security/"><i class="ti ti-lock"></i>Security</a></li>
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

                        <li class="dropdown topbar-action-item topbar-action-user active">
                            <a href="#" data-toggle="dropdown"> <img class="icon" src="../../static/plugins/img/user-thumb-sm.png" alt="thumb"> </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown">
                                    <div class="user-dropdown-head">
                                        <h6 class="user-dropdown-name"><?php echo $first . " " . $last ?><span>(<?php echo $username ?>)</span></h6>
                                        <span class="user-dropdown-email"><?php echo $email ?></span>
                                    </div>
                                    <div class="user-dropdown-balance">
                                        <h6>CURRENT REVENUE</h6>
                                        <h3>$<?php
                                            if (isset($profit_earned)){
                                                echo $profit_earned;
                                            } else {
                                                echo "0.00";
                                            }
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
                                        <li class="active"><a href="../security/"><i class="ti ti-lock"></i>Security</a></li>
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
                        <li class="active"><a href="../security/"><em class="ti ti-lock"></em>Security</a></li>
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
                                <a href="/"><em class="fa fa-home"></em> Go to main site</a>
                            </li><!-- .topbar-action-item -->
                        </ul><!-- .topbar-action-list -->
                    </div>
                </div><!-- .user-sidebar -->


    

                <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">Security Settings</h2>
                        <p>
                            Please, if you suspect any unusual account activity, change your password immediately and send us a report.
                            <br />
                            <a href="mailto:info@coinwealthfx.com?subject=I want to report suspicious activity on my account">Send report</a>
                        </p>
                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" data-toggle="tab" href="#password-opt">Change Password</a>
                            </li>
                        </ul><!-- .nav-tabs-line -->
                        <div class="tab-content" id="security-opt-tab">
                            <div class="tab-pane fade active show" id="password-opt">
                            <?php 
                                if (empty($errors) && (isset($success))){
                                    echo "<p id='success'> $success </p>";
                                }
                                if (!empty($errors)){
                                    echo "<p id='errors'>";
                                    foreach ($errors as $err){
                                        echo $err . "<br />";
                                    }
                                    echo "</p>";
                                }
                            ?>

                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                					<input type="hidden" name="csrfmiddlewaretoken" value="za3gerEOgCKAMBsjl7Lyfujh11OJMQu5IfwMqsArWj8s7YWyYuudR9UdPtwbPVjN">
                					
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item input-with-label">
                                                <label for="swalllet" class="input-item-label">Old Password</label>
                                                <input type="password" name="old_password" class="input-bordered" required="" id="old_password">
                                                
                                            </div><!-- .input-item -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item input-with-label">
                                                <label for="date-of-birth" class="input-item-label">New Password</label>
                                                <input type="password" name="new_password1" class="input-bordered" required="" id="new_password1" minlength="8">
                                                
                                            </div><!-- .input-item -->
                                        </div><!-- .col -->
                                        <div class="col-lg-6">
                                            <div class="input-item input-with-label">
                                                <label for="date-of-birth" class="input-item-label">Confirm New Password</label>
                                                <input type="password" name="new_password2" class="input-bordered" required="" id="new_password2" minlength="8">
                                                
                                            </div><!-- .input-item -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                    <div class="note note-plane note-info">
                                        <em class="fas fa-info-circle"></em>
                                        <p>Password must be at least 8 characters long and include a both numbers and uppercase characters.</p>
                                    </div>
                                    <div class="gaps-3x"></div>
                                    <div class="gaps-1x"></div><!-- 10px gap -->
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <button id="submit" type="submit" disabled="" class="btn btn-primary">Update</button>
                                        <div class="gaps-2x d-sm-none"></div>
                                        <?php echo "
                                        <script>
                                            function validate(){
                                                var old = document.getElementById('old_password'); 
                                                var p1 = document.getElementById('new_password1');
                                                var p2 = document.getElementById('new_password2');
                                                var submit = false;
                                                if (p1.value === p2.value){
                                                    if ((p1.value.length >= 8) && (p2.value.length >= 8)){
                                                        if (old.value.length >= 3){
                                                            submit = true;
                                                        } else {
                                                            submit = false;
                                                        }
                                                    }
                                                }
                                                if (submit === true){
                                                    document.getElementById('submit').disabled = false;
                                                } else {
                                                    document.getElementById('submit').disabled = true;
                                                }
                                            }

                                            setInterval(validate, 1);
                                        </script>
                                        " ?>
                                        
                                    </div>
                                </form><!-- form -->
                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->
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
                    <span class="footer-copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script>, <a href="#"> Coinwealth Investments Limited</a>.<br>All Rights Reserved.</span>
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