<?php

require_once("trash.php");

function sanitize($item){
    $temp = htmlentities((trim($item)));
    return $temp;
}

?>