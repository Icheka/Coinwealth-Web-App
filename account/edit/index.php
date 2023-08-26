<?php
error_reporting(0);
@session_start();

require_once("../../trash.php");
require_once("../../sanitize.php");
//require_once("../../update.php");


if (!isset($_SESSION['username'])){
    header("Location: ../login/index.php");
}

//initialize $value_changed
//track whether the user has updated any values
if ((isset($_GET['qjdhbdjnd'])) && ($_GET['qjdhbdjnd'] == '9837yh8nd')){
    $value_changed = "true";
} else {
    $value_changed = "false";
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

if (isset($_POST['csrfmiddlewaretoken'])){
    extract($_POST, EXTR_PREFIX_ALL, 'post');
    
    $new_first_name = sanitize($post_first_name);
    $new_last_name = sanitize($post_last_name);
    $new_email = sanitize($post_email);
    $new_mobile = sanitize($post_phone);
    $new_country = sanitize($post_country);

    $sql = "UPDATE clients_info SET firstname='$new_first_name' WHERE unique_id = '$unique_id'";
    mysqli_query($conn, $sql);
    $_SESSION['firstname'] = $new_first_name;

    $sql = "UPDATE clients_info SET lastname='$new_last_name' WHERE unique_id = '$unique_id'";
    mysqli_query($conn, $sql);
    $_SESSION['lastname'] = $new_last_name;

    $sql = "UPDATE clients_info SET email='$new_email' WHERE unique_id = '$unique_id'";
    mysqli_query($conn, $sql);
    $_SESSION['email'] = $new_email;

    $sql = "UPDATE clients_info SET mobile='$new_mobile' WHERE unique_id = '$unique_id'";
    mysqli_query($conn, $sql);
    $_SESSION['mobile'] = $new_mobile;

    $sql = "UPDATE clients_info SET country='$new_country' WHERE unique_id = '$unique_id'";
    mysqli_query($conn, $sql);
    $_SESSION['country'] = $new_country;

    header("Location: index.php?qjdhbdjnd=9837yh8nd");

}

?>
<!DOCTYPE html>
<html lang="en" class="js"><head>
	<meta charset="utf-8">
	<meta name="author" content="Softnio">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">

	<link rel="shortcut icon" href="../../static/plugins/img/favicon.png">

	<title>EDIT PROFILE - COINWEALTH INVESTMENTS LIMITED</title>

	<link rel="stylesheet" href="../../static/plugins/css/vendor.bundle.css">
	<link rel="stylesheet" href="../../static/plugins/css/style.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../static/assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../static/assets/css/custom.css" type="text/css">
    <link rel="stylesheet" href="../../static/assets/css/theme.css" type="text/css">
	<link rel="stylesheet" href="../../static/plugins/css/themify/themify-icons.css">

    <style>
        #success {
            width: 100%;
            color: green;
            border: 4px double lightgreen;
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
                            </div> <!--
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
                                    <h3>$
                                        <?php
                                            echo (isset($profit_earned) ? $profit_earned : "0.00")
                                        ?>
                                    </h3>
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
                                    <li class="active"><a href="../edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
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

                        <li class="dropdown topbar-action-item topbar-action-user active">
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
                                                echo (isset($profit_earned) ? $profit_earned : "0.00")
                                            ?>
                                        </h3>
                                        <ul>
                                            <li>0.0 BTC</li>
                                            <li>0.0 ETH</li>
                                            <li>0.0 LTC</li>
                                        </ul>
                                    </div>
                                    <ul class="user-dropdown-links">
                                        <li class="active"><a href="../edit/"><i class="ti ti-id-badge"></i>Edit Profile</a></li>
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
                        <li class="active"><a href="../edit/"><em class="ti ti-id-badge"></em>Edit Profile</a></li>
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
                                <a href="/"><em class="fa fa-home"></em> Go to main site</a>
                            </li><!-- .topbar-action-item -->
                        </ul><!-- .topbar-action-list -->
                    </div>
                </div><!-- .user-sidebar -->


    

                <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">Account Information</h2>
                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#personal-data">Personal Data</a>
                            </li>
                        </ul><!-- .nav-tabs-line -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="personal-data">
                            <?php
                                if ($value_changed == "true"){
                                    echo "<p id='success'> Your changes have been saved! </p>";
                                }
                            ?>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            					<input type="hidden" name="csrfmiddlewaretoken" value="wwnxOnlfvMTzSPskqRzuA53A1J6INWnYFBQ30ohSbthrdcWz3ei9cKEwPbOaQ1cG">
            					
                                    <div class="input-item input-with-label">
                                        <label for="first-name" class="input-item-label">First Name</label>
                                        <input type="text" name="first_name" value="<?php echo $first ?>" class="input-bordered" required="" id="id_first_name">
                                        
                                    </div><!-- .input-item -->
                                    <div class="input-item input-with-label">
                                        <label for="last-name" class="input-item-label">Last Name</label>
                                        <input type="text" name="last_name" value="<?php echo $last ?>" class="input-bordered" required="" id="id_last_name">
                                        
                                    </div><!-- .input-item -->
                                    <div class="input-item input-with-label">
                                        <label for="email-address" class="input-item-label">Email Address</label>
                                        <input type="email" name="email" value="<?php echo $email ?>" class="input-bordered" required="" id="id_email">
                                        
                                    </div><!-- .input-item -->
                                    <div class="input-item input-with-label">
                                        <label for="phone-number" class="input-item-label">Phone Number</label>
                                        <input type="tel" name="phone" value="<?php echo $mobile ?>" class="input-bordered" required="" id="id_phone">
                                        
                                    </div><!-- .input-item -->
                                    <div class="input-item input-with-label">
                                        <label for="country" class="input-item-label">Select Country</label>
                                        <select name="country" class="form-control select2-hidden-accessible" required="" id="id_country" data-select2-id="id_country" tabindex="-1" aria-hidden="true">
  <option value="">(Choose country)</option>

  <option value="AF">Afghanistan</option>

  <option value="AX">�land Islands</option>

  <option value="AL">Albania</option>

  <option value="DZ">Algeria</option>

  <option value="AS">American Samoa</option>

  <option value="AD">Andorra</option>

  <option value="AO">Angola</option>

  <option value="AI">Anguilla</option>

  <option value="AQ">Antarctica</option>

  <option value="AG">Antigua and Barbuda</option>

  <option value="AR">Argentina</option>

  <option value="AM">Armenia</option>

  <option value="AW">Aruba</option>

  <option value="AU">Australia</option>

  <option value="AT">Austria</option>

  <option value="AZ">Azerbaijan</option>

  <option value="BS">Bahamas</option>

  <option value="BH">Bahrain</option>

  <option value="BD">Bangladesh</option>

  <option value="BB">Barbados</option>

  <option value="BY">Belarus</option>

  <option value="BE">Belgium</option>

  <option value="BZ">Belize</option>

  <option value="BJ">Benin</option>

  <option value="BM">Bermuda</option>

  <option value="BT">Bhutan</option>

  <option value="BO">Bolivia</option>

  <option value="BQ">Bonaire, Sint Eustatius and Saba</option>

  <option value="BA">Bosnia and Herzegovina</option>

  <option value="BW">Botswana</option>

  <option value="BV">Bouvet Island</option>

  <option value="BR">Brazil</option>

  <option value="IO">British Indian Ocean Territory</option>

  <option value="BN">Brunei</option>

  <option value="BG">Bulgaria</option>

  <option value="BF">Burkina Faso</option>

  <option value="BI">Burundi</option>

  <option value="CV">Cabo Verde</option>

  <option value="KH">Cambodia</option>

  <option value="CM">Cameroon</option>

  <option value="CA">Canada</option>

  <option value="KY">Cayman Islands</option>

  <option value="CF">Central African Republic</option>

  <option value="TD">Chad</option>

  <option value="CL">Chile</option>

  <option value="CN">China</option>

  <option value="CX">Christmas Island</option>

  <option value="CC">Cocos (Keeling) Islands</option>

  <option value="CO">Colombia</option>

  <option value="KM">Comoros</option>

  <option value="CG">Congo</option>

  <option value="CD">Congo (the Democratic Republic of the)</option>

  <option value="CK">Cook Islands</option>

  <option value="CR">Costa Rica</option>

  <option value="CI">C�te d'Ivoire</option>

  <option value="HR">Croatia</option>

  <option value="CU">Cuba</option>

  <option value="CW">Cura�ao</option>

  <option value="CY">Cyprus</option>

  <option value="CZ">Czechia</option>

  <option value="DK">Denmark</option>

  <option value="DJ">Djibouti</option>

  <option value="DM">Dominica</option>

  <option value="DO">Dominican Republic</option>

  <option value="EC">Ecuador</option>

  <option value="EG">Egypt</option>

  <option value="SV">El Salvador</option>

  <option value="GQ">Equatorial Guinea</option>

  <option value="ER">Eritrea</option>

  <option value="EE">Estonia</option>

  <option value="SZ">Eswatini</option>

  <option value="ET">Ethiopia</option>

  <option value="FK">Falkland Islands  [Malvinas]</option>

  <option value="FO">Faroe Islands</option>

  <option value="FJ">Fiji</option>

  <option value="FI">Finland</option>

  <option value="FR">France</option>

  <option value="GF">French Guiana</option>

  <option value="PF">French Polynesia</option>

  <option value="TF">French Southern Territories</option>

  <option value="GA">Gabon</option>

  <option value="GM">Gambia</option>

  <option value="GE">Georgia</option>

  <option value="DE">Germany</option>

  <option value="GH">Ghana</option>

  <option value="GI">Gibraltar</option>

  <option value="GR">Greece</option>

  <option value="GL">Greenland</option>

  <option value="GD">Grenada</option>

  <option value="GP">Guadeloupe</option>

  <option value="GU">Guam</option>

  <option value="GT">Guatemala</option>

  <option value="GG">Guernsey</option>

  <option value="GN">Guinea</option>

  <option value="GW">Guinea-Bissau</option>

  <option value="GY">Guyana</option>

  <option value="HT">Haiti</option>

  <option value="HM">Heard Island and McDonald Islands</option>

  <option value="VA">Holy See</option>

  <option value="HN">Honduras</option>

  <option value="HK">Hong Kong</option>

  <option value="HU">Hungary</option>

  <option value="IS">Iceland</option>

  <option value="IN">India</option>

  <option value="ID">Indonesia</option>

  <option value="IR">Iran</option>

  <option value="IQ">Iraq</option>

  <option value="IE">Ireland</option>

  <option value="IM">Isle of Man</option>

  <option value="IL">Israel</option>

  <option value="IT">Italy</option>

  <option value="JM">Jamaica</option>

  <option value="JP">Japan</option>

  <option value="JE">Jersey</option>

  <option value="JO">Jordan</option>

  <option value="KZ">Kazakhstan</option>

  <option value="KE">Kenya</option>

  <option value="KI">Kiribati</option>

  <option value="KW">Kuwait</option>

  <option value="KG">Kyrgyzstan</option>

  <option value="LA">Laos</option>

  <option value="LV">Latvia</option>

  <option value="LB">Lebanon</option>

  <option value="LS">Lesotho</option>

  <option value="LR">Liberia</option>

  <option value="LY">Libya</option>

  <option value="LI">Liechtenstein</option>

  <option value="LT">Lithuania</option>

  <option value="LU">Luxembourg</option>

  <option value="MO">Macao</option>

  <option value="MG">Madagascar</option>

  <option value="MW">Malawi</option>

  <option value="MY">Malaysia</option>

  <option value="MV">Maldives</option>

  <option value="ML">Mali</option>

  <option value="MT">Malta</option>

  <option value="MH">Marshall Islands</option>

  <option value="MQ">Martinique</option>

  <option value="MR">Mauritania</option>

  <option value="MU">Mauritius</option>

  <option value="YT">Mayotte</option>

  <option value="MX">Mexico</option>

  <option value="FM">Micronesia (Federated States of)</option>

  <option value="MD">Moldova</option>

  <option value="MC">Monaco</option>

  <option value="MN">Mongolia</option>

  <option value="ME">Montenegro</option>

  <option value="MS">Montserrat</option>

  <option value="MA">Morocco</option>

  <option value="MZ">Mozambique</option>

  <option value="MM">Myanmar</option>

  <option value="NA">Namibia</option>

  <option value="NR">Nauru</option>

  <option value="NP">Nepal</option>

  <option value="NL">Netherlands</option>

  <option value="NC">New Caledonia</option>

  <option value="NZ">New Zealand</option>

  <option value="NI">Nicaragua</option>

  <option value="NE">Niger</option>

  <option value="NG">Nigeria</option>

  <option value="NU">Niue</option>

  <option value="NF">Norfolk Island</option>

  <option value="KP">North Korea</option>

  <option value="MK">North Macedonia</option>

  <option value="MP">Northern Mariana Islands</option>

  <option value="NO">Norway</option>

  <option value="OM">Oman</option>

  <option value="PK">Pakistan</option>

  <option value="PW">Palau</option>

  <option value="PS">Palestine, State of</option>

  <option value="PA">Panama</option>

  <option value="PG">Papua New Guinea</option>

  <option value="PY">Paraguay</option>

  <option value="PE">Peru</option>

  <option value="PH">Philippines</option>

  <option value="PN">Pitcairn</option>

  <option value="PL">Poland</option>

  <option value="PT">Portugal</option>

  <option value="PR">Puerto Rico</option>

  <option value="QA">Qatar</option>

  <option value="RE">R�union</option>

  <option value="RO">Romania</option>

  <option value="RU">Russia</option>

  <option value="RW">Rwanda</option>

  <option value="BL">Saint Barth�lemy</option>

  <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>

  <option value="KN">Saint Kitts and Nevis</option>

  <option value="LC">Saint Lucia</option>

  <option value="MF">Saint Martin (French part)</option>

  <option value="PM">Saint Pierre and Miquelon</option>

  <option value="VC">Saint Vincent and the Grenadines</option>

  <option value="WS">Samoa</option>

  <option value="SM">San Marino</option>

  <option value="ST">Sao Tome and Principe</option>

  <option value="SA">Saudi Arabia</option>

  <option value="SN">Senegal</option>

  <option value="RS">Serbia</option>

  <option value="SC">Seychelles</option>

  <option value="SL">Sierra Leone</option>

  <option value="SG">Singapore</option>

  <option value="SX">Sint Maarten (Dutch part)</option>

  <option value="SK">Slovakia</option>

  <option value="SI">Slovenia</option>

  <option value="SB">Solomon Islands</option>

  <option value="SO">Somalia</option>

  <option value="ZA">South Africa</option>

  <option value="GS">South Georgia and the South Sandwich Islands</option>

  <option value="KR">South Korea</option>

  <option value="SS">South Sudan</option>

  <option value="ES">Spain</option>

  <option value="LK">Sri Lanka</option>

  <option value="SD">Sudan</option>

  <option value="SR">Suriname</option>

  <option value="SJ">Svalbard and Jan Mayen</option>

  <option value="SE">Sweden</option>

  <option value="CH">Switzerland</option>

  <option value="SY">Syria</option>

  <option value="TW">Taiwan</option>

  <option value="TJ">Tajikistan</option>

  <option value="TZ">Tanzania</option>

  <option value="TH">Thailand</option>

  <option value="TL">Timor-Leste</option>

  <option value="TG">Togo</option>

  <option value="TK">Tokelau</option>

  <option value="TO">Tonga</option>

  <option value="TT">Trinidad and Tobago</option>

  <option value="TN">Tunisia</option>

  <option value="TR">Turkey</option>

  <option value="TM">Turkmenistan</option>

  <option value="TC">Turks and Caicos Islands</option>

  <option value="TV">Tuvalu</option>

  <option value="UG">Uganda</option>

  <option value="UA">Ukraine</option>

  <option value="AE">United Arab Emirates</option>

  <option value="GB">United Kingdom</option>

  <option value="UM">United States Minor Outlying Islands</option>

  <option value="US" selected="" data-select2-id="2">United States of America</option>

  <option value="UY">Uruguay</option>

  <option value="UZ">Uzbekistan</option>

  <option value="VU">Vanuatu</option>

  <option value="VE">Venezuela</option>

  <option value="VN">Vietnam</option>

  <option value="VG">Virgin Islands (British)</option>

  <option value="VI">Virgin Islands (U.S.)</option>

  <option value="WF">Wallis and Futuna</option>

  <option value="EH">Western Sahara</option>

  <option value="YE">Yemen</option>

  <option value="ZM">Zambia</option>

  <option value="ZW">Zimbabwe</option>

</select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 600px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-id_country-container"><span class="select2-selection__rendered" id="select2-id_country-container" role="textbox" aria-readonly="true" title="United States of America">United States of America</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        
                                    </div><!-- .input-item -->
                                    <div class="gaps-1x"></div><!-- 10px gap -->
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <div class="gaps-2x d-sm-none"></div>
                                        
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