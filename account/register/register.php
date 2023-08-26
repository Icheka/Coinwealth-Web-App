<?php

/*
 * The 'csrfmiddlewaretoken' provides some security 
 * against malicious users trying to spoof/sniff 
 * the auth system
 */
if (!isset($_POST['csrfmiddlewaretoken'])) die("Invalid command. Click <a href='index.html'>here</a> to return to Register.");

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
    $password = password_hash($post_password1, PASSWORD_DEFAULT);
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

if (is_already_taken($username, "username", $conn) == TRUE){
    $errors[] = "This username is taken!";
}
if (is_already_taken($email, "email", $conn) == FALSE){
    $errors[] = "This email address is already registered. Click 'Forgot Password' in the Login page if you lost your password.";
}

if (empty($errors)) {
    $can_continue = TRUE;
}


/*
 * Database query
 */
if ($can_continue){
    
    $sql = "INSERT INTO clients_info (firstname, lastname, username, email, mobile, country, password, unique_id) "
            . "VALUES ('$firstname', '$lastname', '$username', '$email', '$mobile', '$country', '$password', '$unique_id')";
    $result = mysqli_query($conn, $sql);

    if ($result){
        header("Location: ../login/index.html");
    } else {
        $errors[] = "<h2>Bad news!</h2>
                <p>We regret to tell you that we encountered a problem registering you. 
                Try again. If you are still unable to be registered, <a href='../../contact.html'>contact us</a>.</p>";

    }
    mysqli_free_result($conn);
    mysqli_close($conn);
}
?>