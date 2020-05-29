<?php

header("Refresh:10");
$servername = "localhost";
$username = "root";
$password = "";
$db = "MeteoStanica";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 
$today =  date("Y-m-d");
$sql = "SELECT * FROM DATA ORDER BY TIME DESC LIMIT 10";

    $data = [];
    $result = mysqli_query($conn,$sql);
    foreach ($result as $row) {
        $data[] = $row;  
}

$result->close();
$conn->close();

echo json_encode($data);
?>

