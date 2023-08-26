<?php

/*
 * The 'csrfmiddlewaretoken' provides some security 
 * against malicious users trying to spoof/sniff 
 * the auth system
 */
//if (!isset($_POST['csrfmiddlewaretoken'])) die("Invalid command. Click <a href='index.html'>here</a> to return to Register.");

extract($_POST, EXTR_PREFIX_ALL, "post");
require_once("../../../trash.php");
require_once("../../../sanitize.php");

/*
 * New ERRORS array
 */
$errors = [];

/*
 * sanitize inputs
 */
if (isset($_POST['csrfmiddlewaretoken'])){
    
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
$unique_id = mt_rand(2222, 9999) . $date;

/*
 * Can continue?
 */
$can_continue = FALSE;

/*
 * Check if the email and username are available
 */

if (empty($errors)) {
    $can_continue = TRUE;
}


/*
 * Database query
 */
if (($can_continue == TRUE)){
    
    $sql = "INSERT INTO admins_info (firstname, lastname, email, mobile, pass, unique_id) "
     . "VALUES ('$firstname', '$lastname', '$email', '$mobile', '$password', '$unique_id')";
    $result = mysqli_query($conn, $sql);

    if ($result){
        header("Location: ./login.php");
    } else {
        die(mysqli_error($conn));
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

    <link rel="shortcut icon" href="../../../static/assets/img/favicon.png">

    <title>CREATE ADMIN - COINWEALTH INVESTMENTS LIMITED</title>
    
    <link rel="stylesheet" href="../../../static/assets/css/vendor.bundle.css">
    <link rel="stylesheet" href="../../../static/assets/css/style-salvia.css" id="changeTheme">
    <link rel="stylesheet" href="../../../static/assets/css/theme.css">
    <link rel="stylesheet" href="../../../static/assets/css/font-awesome/css/font-awesome.min.css">
    
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
                                <input type="password" name="password1" class="form-control" placeholder="Password" required id="id_password1">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="password" name="password2" class="form-control" placeholder="Password Confirmation" required id="id_password2">
                                  
                            </div>
                        </div>
                        <center><button class="btn btn-primary btn-block btn-md">CREATE ADMIN</button></center>
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
	<script src="../../../static/assets/js/jquery.bundle.js"></script>
	<script src="../../../static/assets/js/scripts.js"></script>
	<script src="../../../static/assets/js/charts.js"></script>
        <script src="../../../static/assets/js/app.js"></script>
</body>
</html>
