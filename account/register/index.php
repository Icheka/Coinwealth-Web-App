<?php

/*
 * The 'csrfmiddlewaretoken' provides some security 
 * against malicious users trying to spoof/sniff 
 * the auth system
 */
//if (!isset($_POST['csrfmiddlewaretoken'])) die("Invalid command. Click <a href='index.html'>here</a> to return to Register.");

extract($_POST, EXTR_PREFIX_ALL, "post");
require_once("../../trash.php");
require_once("../../sanitize.php");

/*
 * New ERRORS array
 */
$errors = [];

/*
 * sanitize inputs
 */
if (isset($_POST['csrfmiddlewaretoken'])){
    
$username = sanitize($post_username);
$firstname = sanitize($post_first_name);
$lastname = sanitize($post_last_name);
if (!filter_var(sanitize($post_email), FILTER_VALIDATE_EMAIL)){
    $errors[] = "Invalid email address. <br />
            For your security we require a valid email address. <br />
            . Click <a href='index.html'>here</a> to return to Register.";
} else {
    $email = filter_var(sanitize($post_email), FILTER_VALIDATE_EMAIL);
}
$mobile = sanitize($post_phone);
$country = sanitize($post_country);
if ($post_password1 === $post_password2){
    $password = password_hash($post_password1, PASSWORD_BCRYPT);
} else {
    $errors[] = "Your passwords do not match! <br />
            For your security we require a valid password. <br />
            . Click <a href='index.html'>here</a> to return to Register.";
}
/*
 * Generate unique id
 */
$date = date("dmy");
$unique_id = mt_rand(100000, 999999) . $date;

/*
 * Can continue?
 */
$can_continue = FALSE;

/*
 * Check if the email and username are available
 */
require_once("../../is_already_registered.php");

/*
 * Check if username or email is already registered
 */
$q1 = "SELECT * FROM clients_info WHERE username='$username'";
$q2 = "SELECT * FROM clients_info WHERE email='$email'";
$r1 = mysqli_query($conn, $q1);
$r2 = mysqli_query($conn, $q2);
if (mysqli_num_rows($r1)){
    $errors[] = "This username is taken! <br />";
} else if (mysqli_num_rows($r2)){
    $errors[] = "This email address is already registered. Click 'Forgot Password' in the Signin page if you lost your password. <br />";
}

/*
if (is_already_taken($username, "username", $conn) == TRUE){
    $errors[] = "This username is taken! <br />";
}
if (is_already_taken($email, "email", $conn) == TRUE){
    $errors[] = "This email address is already registered. Click 'Forgot Password' in the Login page if you lost your password. <br />";
}
*/
if (empty($errors)) {
    $can_continue = TRUE;
}


/*
 * Database query
 */
if (($can_continue == TRUE)){
    
    $sql = "INSERT INTO clients_info (firstname, lastname, username, email, mobile, country, pass, unique_id, reg_date) "
            . "VALUES ('$firstname', '$lastname', '$username', '$email', '$mobile', '$country', '$password', '$unique_id', NOW())";
    $result = mysqli_query($conn, $sql);

    if ($result){
        $_SESSION = [];
        session_destroy();
        header("Location: ../login/index.php");
    } else {
        $errors[] = "<h2>Bad news!</h2>
                <p>We regret to tell you that we encountered a problem registering you. 
                Try again. If you are still unable to be registered, <a href='../../contact.html'>contact us</a>.</p>";

    }
    mysqli_free_result($conn);
    mysqli_close($conn);
}
// End first IF
} 
?>
<!DOCTYPE html>
<html lang="en" class="js">


<head>
    <meta charset="utf-8">
    <meta name="author" content="Ozuru, Icheka Fortune">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Coinwealth Investments Limited is an active cryptocurrency investment company incorporated on 26 March 2020 with the registered office located in Cheadle, Greater Manchester.">

    <link rel="shortcut icon" href="../../static/assets/img/favicon.png">

    <title>REGISTER - COINWEALTH INVESTMENTS LIMITED</title>
    
    <link rel="stylesheet" href="../../static/assets/css/vendor.bundle.css">
    <link rel="stylesheet" href="../../static/assets/css/style-salvia.css" id="changeTheme">
    <link rel="stylesheet" href="../../static/assets/css/theme.css">
    <link rel="stylesheet" href="../../static/assets/css/font-awesome/css/font-awesome.min.css">
    
    <style>
        #errors {
            width: 100%;
            color: red;
            border: 2px solid red;
            border-radius: 6px;
            padding: 1em;
        }
    </style>
        
</head>



    <body class="nk-body body-wider bg-light-alt">

	<div class="nk-wrap">

    

        <main class="nk-pages nk-pages-centered bg-theme">
            <div class="ath-container">
                <div class="ath-header text-center">
                    <a href="../../index.html" class="ath-logo"><img src="../../static/assets/img/logo-full-white.png"></a>
                </div>
                <div class="ath-body">
                    <h5 class="ath-heading title">Sign Up <small class="tc-default">Create New Account</small></h5>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <?php
                            if (!empty($errors)){
                                echo "<div id='errors'>";
                                foreach ($errors as $err) {
                                    echo $err;
                                }
                                echo "</div>";
                            }
                        ?>
                        <input type="hidden" name="csrfmiddlewaretoken" value="5Xse32UoO3GpNVOXk26asTbcbpVX3qsku7J3tYjsByHFzoTOFwicim4T31FfWyGl">
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="text" name="username" class="form-control" placeholder="Username" autofocus required id="id_username">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required id="id_first_name">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required id="id_last_name">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="email" name="email" class="form-control" placeholder="Email" required id="id_email">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="tel" name="phone" placeholder="Phone Number" class="form-control" required id="id_phone">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <select name="country" class="form-control" required id="id_country">
  <option value="" selected>(Choose country)</option>

  <option value="AF">Afghanistan</option>

  <option value="AX">Åland Islands</option>

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

  <option value="CI">Côte d&#39;Ivoire</option>

  <option value="HR">Croatia</option>

  <option value="CU">Cuba</option>

  <option value="CW">Curaçao</option>

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

  <option value="RE">Réunion</option>

  <option value="RO">Romania</option>

  <option value="RU">Russia</option>

  <option value="RW">Rwanda</option>

  <option value="BL">Saint Barthélemy</option>

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

  <option value="US">United States of America</option>

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

</select>
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="password" name="password1" class="form-control" placeholder="Password" required id="id_password1">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="password" name="password2" class="form-control" placeholder="Password Confirmation" required id="id_password2">
                                  
                            </div>
                        </div>
                        <center><button class="btn btn-primary btn-block btn-md">Sign Up</button></center>
                        <div class="ath-note text-center">
                            <p>Already on telegram? <a href="http://t.me/pennyworthfx_bot"><strong>Sign up with our telegram bot!</strong></a></p>
                            <p>Already have an account? <a href="../login/index.html"> <strong>Sign in here</strong></a></p>
                        </div>
                    </form>

                    <?php
                        if (!empty($_GET['errors'])){
                            echo "<p id='error'>";
                            foreach ($errors as $e){
                                echo $e . '<br />';
                            }
                            echo "</p>";
                        }
                    ?>
            </div>
        </main>

	

	</div>
	<!-- preloader -->
	<div class="preloader preloader-alt no-split"><span class="spinner spinner-alt"><img class="spinner-brand" src="../../static/assets/img/logo-full-white.png" alt=""></span></div>


	<!-- JavaScript -->
	<script src="../../static/assets/js/jquery.bundle.js"></script>
	<script src="../../static/assets/js/scripts.js"></script>
	<script src="../../static/assets/js/charts.js"></script>
        <script src="../../static/assets/js/app.js"></script>
</body>
</html>
