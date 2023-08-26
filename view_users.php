<?php

require_once 'trash.php';

$sql = "SELECT * FROM clients_info";
$resource = mysqli_query($conn, $sql);

echo "<table>"
. "<tr>"
        . "<th>First Name</th><th>Last Name</th><th>Middle Name</th><th>Username</th>"
        . "<th>Email</th><th>Mobile</th><th>Country</th>";

while ($row = mysqli_fetch_array($resource, MYSQLI_BOTH)){
    echo "<tr>"
    . "<td>$row[firstname]</td><td>$row[lastname]</td>
        <td>$row[middlename]</td><td>$row[username]</td><td>$row[email]</td><td>$row[mobile]</td>
        <td>$row[country]</td>"
    . "</tr>";
}
mysqli_free_result($conn);
mysqli_close($conn);

echo "</table>";

?>