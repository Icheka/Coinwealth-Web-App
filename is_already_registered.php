<?php 

require_once("trash.php");
$conn = @mysqli_connect(db_server, db_user, db_pass, db_base);

function is_already_taken($item, $type, $conn){
    
    $sql = "SELECT * FROM clients_info where '$type'='$item'";
    $resource = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($resource) > 0){
        return TRUE;
    } else {
        return FALSE;
    }
}

?>