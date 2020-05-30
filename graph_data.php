<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "MeteoStanica";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 

$sqlS = $conn->query("SELECT hodnota FROM parameter;");
$row_param = $sqlS->fetch_assoc();
$parameter = $row_param["hodnota"];

if($parameter == "3days") {
    $today =  date("Y-m-d");
    $day3 = date("Y-m-d", strtotime( '-2 days'));
    $sql = "SELECT * FROM DATA WHERE TIME BETWEEN '$day3' AND '$today 23:59:59.999'";
}
else {
    $sql = "SELECT * FROM DATA WHERE TIME LIKE '$parameter%'";
}
$sqlD = "DELETE FROM parameter";
$conn->query($sqlD);
$today =  date("Y-m-d");
$sqlI = "INSERT INTO parameter (hodnota) VALUES ('$today')";
$conn->query($sqlI);

$data = [];
$result = mysqli_query($conn,$sql);
foreach ($result as $row) {
    $data[] = $row;  
}

$result->close();
$conn->close();

echo json_encode($data);
?>

