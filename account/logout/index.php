<?php
error_reporting(0);
@session_start();

    $_SESSION = []; 
    session_unset();
    session_destroy();

?>

<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="utf-8">
    <meta author="Ozuru, Icheka Fortune">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoinWealth Investments Limited is an active cryptocurrency investment company incorporated on 26 March 2017 with the registered office located in Cheadle, Greater Manchester.">

    <link rel="shortcut icon" href="../../static/assets/img/favicon.png">

    <title>LOGIN - COINWEALTH INVESTMENTS LIMITED</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../static/assets/css/vendor.bundle.css">
    <link rel="stylesheet" href="../../static/assets/css/style-salvia.css" id="changeTheme">
    <link rel="stylesheet" href="../../static/assets/css/font-awesome/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../../static/assets/css/theme.css">

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
                    <a href="../../index.html" class="ath-logo"><img src="../../static/assets/img/logo-full-white.png" alt="logo"></a>
                </div>
                <div class="ath-body">
                    <p id="errors">
                        Your Coinwealth account has been successfully logged out. <br />
                        We recommend logging out after every session for added security.
                    </p>
                </div>
                <div class="ath-note text-center tc-light">
                    <p>
                        You will be automatically redirected to HOME.
                    </p>
                </div>
            </div>
        </main>
    <script>
        setTimeout(() => {
            window.location.replace("../../index.html");
        }, 3000);    
    </script>


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
