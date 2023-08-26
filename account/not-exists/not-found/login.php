<?php
error_reporting(0);
@session_start();

require_once("../../../trash.php");
require_once("../../../sanitize.php");

$logged_in = "";
$tries = 0;

$errors = [];


if (isset($_POST['csrfmiddlewaretoken'])){
    extract($_POST, EXTR_PREFIX_ALL, "post");
    $id = sanitize($post_id);
    $password = sanitize($post_password);
    
    $sql = "SELECT pass FROM admins_info WHERE unique_id='$id'";
    $resource = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resource)){
        while ($user_creds = mysqli_fetch_array($resource, MYSQLI_ASSOC)){
            $user_password = $user_creds['pass'];
        }
        if (password_verify($password, $user_password) == TRUE){
            $logged_in = TRUE;
        } else {
            $logged_in = FALSE;
            $tries ++;
        }
    } else {
        $errors[] = "We don't recognize you.";
    //End IF (MYSQLI_NUM_ROWS...
    }
//END OF IF ISSET...    
}

if ($logged_in == TRUE){
    $_SESSION['admin'] = "";
    $_SESSION['id'] = $id;
    $_SESSION['password'] = $user_password;
    header("Location: ./admin.php");
} elseif (($logged_in == FALSE) && ($tries > 0)){
    $errors[] = "We don't recognize you.";
}


?>
<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="utf-8">
    <meta author="Ozuru, Icheka Fortune">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoinWealth Investments Limited is an active cryptocurrency investment company incorporated on 26 March 2017 with the registered office located in Cheadle, Greater Manchester.">

    <link rel="shortcut icon" href="../../../static/assets/img/favicon.png">

    <title>ADMIN - COINWEALTH INVESTMENTS LIMITED</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../../static/assets/css/vendor.bundle.css">
    <link rel="stylesheet" href="../../../static/assets/css/style-salvia.css" id="changeTheme">
    <link rel="stylesheet" href="../../../static/assets/css/font-awesome/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../../../static/assets/css/theme.css">

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
                    <h5 class="ath-heading title">Sign in <small class="tc-default">with your account details</small></h5>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                            <?php if (!empty($errors)){
                                echo "<p id='errors'>";
                                foreach ($errors as $err){
                                    echo $err;
                                }
                                echo "</p>";
                            }
                            ?>
                        <input type="hidden" name="csrfmiddlewaretoken" value="I1ix3es7W5snVjVbvLNvXPdr0Tmqlb5t7bzmtaRbJAtDHM02QfZxNi68Sv6Iejju">
                        
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="text" name="id" class="form-control" placeholder="UNIQUE ID" required id="id_username">
                                
                            </div>
                        </div>
                        <div class="field-item">
                            <div class="field-wrap">
                                <input type="password" name="password" class="form-control" placeholder="Password" required id="id_password">
                                
                            </div>
                        </div>
                        <center><button class="btn btn-primary btn-block btn-md">Sign In</button></center>
                    </form>
                </div>
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
