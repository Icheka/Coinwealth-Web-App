<?php

error_reporting(0);

DEFINE('db_server', 'localhost');
DEFINE('db_user', 'root');
DEFINE('db_pass', '');
DEFINE('db_base', 'clients');

$conn = mysqli_connect(db_server, db_user, db_pass, db_base);
if (mysqli_connect_errno()){
	echo "Sorry. We are currently undergoing routine updates to our systems.
	<br /> Give us a minute and try again";
	exit();
}
mysqli_set_charset($conn, 'utf8');

?>