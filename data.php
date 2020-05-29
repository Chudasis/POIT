<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "MeteoStanica";

$conn = new mysqli($servername, $username, $password, $db);

$result = $conn->query("SELECT * FROM DATA ORDER BY TIME DESC LIMIT 10");
if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             echo '<tr>
                    <td>'.$row["temperature"].'</td>
                    <td>'.$row["light"].'</td>
                    <td>'.$row["humidity"].'</td>
                    <td>'.$row["time"].'</td>
         </tr>';
        }
}
?>

