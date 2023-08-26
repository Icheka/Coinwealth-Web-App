<?php
error_reporting(0);
@session_start();

$unique_id = $_SESSION['unique_id'];

//require_once("trash.php");

/*..
    * I couldnt figure out a way to include trash.php due to issues with the file path
    * so I'm basically just copy-pasting here ;))
    ..*/
    DEFINE('db_server', 'localhost');
    DEFINE('db_user', 'root');
    DEFINE('db_pass', '');

    $conn = mysqli_connect(db_server, db_user, db_pass);
    if (mysqli_connect_errno()){
        echo "Sorry. We are currently undergoing routine updates to our systems.
        <br /> Give us a minute and try again";
        exit();
    }
    mysqli_set_charset($conn, 'utf8');


function updateTable($column_name, $column_value, $table_name, $db_name){

    /*..
    * set global $unique_id
    ..*/
    global $unique_id;

    //echo $column_name . " " . $column_value . " " . $table_name . " " . $unique_id;
    //die();

    mysqli_select_db($conn, $db_name);
    
    //$sql = "UPDATE '$table_name'" . " SET '$column_name'" . " = '$column_value'" . " WHERE 'unique_id' = '$unique_id'";
    $sql = "UPDATE clients_info SET firstname = 'GG' WHERE unique_id='$unique_id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        die("sus");
    } else {
        die(mysqli_error($conn));
    }

    if (mysqli_errno($conn)){
        die(mysqli_error($conn));
    }
    die($result);

    mysqli_free_result($result);

}
