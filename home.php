<?php

$page = $_SERVER['PHP_SELF'];
$sec = "10";

setlocale(LC_ALL, 'sk_SK');

$servername = "localhost";
$username = "root";
$password = "";
$db = "MeteoStanica";
$temperature = 0;
$humidity = 0;
$light = 0;

$conn = new mysqli($servername, $username, $password, $db);

$actuall = $conn->query("SELECT * FROM DATA ORDER BY TIME DESC LIMIT 1");
$row_actuall = $actuall->fetch_assoc();

function get_by_date($conn, $date) 
{
    $count = 0;
    $array = [];
    $temperature = 0;
    $humidity = 0;
    $light = 0;
    $today_all = $conn->query("SELECT * FROM DATA WHERE TIME LIKE '" .$date . "%'");
    while ($row = $today_all->fetch_assoc()) {
        $temperature += $row['temperature'];
        $humidity += $row['humidity'];
        $light += $row['light'];
        $count += 1;
    }
    if ($count==0)
    {
        $array[0] = '-';
        $array[1] = '-';
        $array[2] = '-';
        $array[3] = '-';
        $array[4] = '-';
    }
    else
    {
        $array[0] = round($temperature / $count, 2);
        $array[1] = round($humidity / $count, 2);
        $array[2] = round($light / $count, 2);
    
        $max = $conn->query("SELECT MAX(TEMPERATURE) as max FROM DATA WHERE TIME LIKE '" .$date . "%'");
        $row_max = $max->fetch_assoc();
        $array[3] = $row_max["max"];
    
        $min = $conn->query("SELECT MIN(TEMPERATURE) as min FROM DATA WHERE TIME LIKE '" .$date . "%'");
        $row_min = $min->fetch_assoc();
        $array[4] = $row_min["min"];
    }
    return $array;
}

$today_db = date("Y-m-d");
$today_date = date("d.m.Y");
$today_day = mb_strtoupper(strftime("%A"));
$today = get_by_date($conn,$today_db);

$yesterday_db = date("Y-m-d", strtotime( '-1 days'));
$yesterday_date = date("d.m.Y", strtotime( '-1 days'));
$yesterday_day = mb_strtoupper(strftime("%A", strtotime( '-1 days')));
$yesterday = get_by_date($conn,$yesterday_db);

$day3_db = date("Y-m-d", strtotime( '-2 days'));
$day3_date = date("d.m.Y", strtotime( '-2 days'));
$day3_day = mb_strtoupper(strftime("%A", strtotime( '-2 days')));
$day3 = get_by_date($conn,$day3_db);

$day4_db = date("Y-m-d", strtotime( '-3 days'));
$day4_date = date("d.m.Y", strtotime( '-3 days'));
$day4_day = mb_strtoupper(strftime("%A", strtotime( '-3 days')));
$day4 = get_by_date($conn,$day4_db);

$day5_db = date("Y-m-d", strtotime( '-4 days'));
$day5_date = date("d.m.Y", strtotime( '-4 days'));
$day5_day = mb_strtoupper(strftime("%A", strtotime( '-4 days')));
$day5 = get_by_date($conn,$day5_db);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Filip Chudiak</title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Balsamiq+Sans?subset=latin">
    <script type="text/javascript" charset="utf-8"></script>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">

    <style>
        body {
            background-image: url("Images/body.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
        .jumbotron {
            background: transparent;
            padding: 20px 30px 0px 30px;
            height: 100px;
            margin: 0px;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: #484848;
            text-align: center;
            background-color: #ced1d2;
        }

        .footer p {
            margin: 5px;
            font-size: 12px;
        }

        #myTab {
            background-color: transparent;
        }

        a {
            color: black;
        }

        a:hover {
            color: darkred;
        }

        .container {
            padding-top: 40px;
            text-align: center;

        }

        #avg {
            font-size: 12px;
        }

        #th-day {
            font-size: 12px;
            margin: 10px 0px 0px 0px;
        }

        table {
            background:rgba(255,255,255,0.35);
        }
        
    </style>
</head>

<body>
    <div class="jumbotron text-center">
        <h3>Meteostanica</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab"  href="#home" role="tab" aria-controls="home"
                aria-selected="true">Domov</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" href="graph.php" role="tab">Grafy</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" href="actuall.php" role="tab">Vypis</a>
        </li>
    </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
                <div class="row" style="padding-top: 50px;" ;>
                    <div class="col row">
                        <div class="col">
                            <img src="Images/teplomer.png" alt="Test Image" height="100px" style="float: left;"/>
                            <h3><?php echo $row_actuall['temperature']; ?>°C</h3>
                            <h6>Teplota</h6>
                        </div>
                    </div>
                    <div class="col row">
                        <div class="col">
                            <img src="Images/humidity.png" alt="Test Image" height="100px" style="float: left;" />
                            <h3><?php echo $row_actuall['humidity']; ?>%</h3>
                            <h6>Vlhkosť</h6>
                        </div>
                    </div>
                    <div class="col row">
                        <div class="col">
                            <img src="Images/bulb.png" alt="Test Image" height="100px" style="float: left;" />
                            <h3><?php echo $row_actuall['light']; ?>%</h3>
                            <h6>Svietivosť</h6>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 80px;" ;>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <?php echo $today_day; ?>
                                    <p id="th-day"><?php echo $today_date; ?></p>
                                </th>
                                <th scope="col">
                                    <?php echo $yesterday_day; ?>
                                    <p id="th-day"><?php echo $yesterday_date; ?></p>
                                </th>
                                <th scope="col">
                                    <?php echo $day3_day; ?>
                                    <p id="th-day"><?php echo $day3_date; ?></p>
                                </th>
                                <th scope="col">
                                    <?php echo $day4_day; ?>    
                                    <p id="th-day"><?php echo $day4_date; ?></p>
                                </th>
                                <th scope="col">
                                    <?php echo $day5_day; ?>
                                    <p id="th-day"><?php echo $day5_date; ?></p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p><?php echo $today[0]?>°C </p>
                                    <p id="avg">MAX: <?php echo $today[3]?>°C &nbsp;&nbsp;&nbsp; MIN: <?php echo $today[4]?>°C</p>
                                </td>
                                <td>
                                    <p><?php echo $yesterday[0]?>°C </p>
                                    <p id="avg">MAX: <?php echo $yesterday[3]?>°C&nbsp;&nbsp;&nbsp;MIN: <?php echo $yesterday[4]?>°C</p>
                                </td>
                                <td>
                                    <p><?php echo $day3[0]?>°C </p>
                                    <p id="avg">MAX: <?php echo $day3[3]?>°C&nbsp;&nbsp;&nbsp;MIN: <?php echo $day3[4]?>°C</p>
                                </td>
                                <td>
                                    <p><?php echo $day4[0]?>°C </p>
                                    <p id="avg">MAX: <?php echo $day4[3]?>°C&nbsp;&nbsp;&nbsp;MIN: <?php echo $day4[4]?>°C</p>
                                </td>
                                <td>
                                    <p><?php echo $day5[0]?>°C </p>
                                    <p id="avg">MAX: <?php echo $day5[3]?>°C&nbsp;&nbsp;&nbsp;MIN: <?php echo $day5[4]?>°C</p>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $today[1]; ?>%</td>
                                <td><?php echo $yesterday[1]; ?>%</td>
                                <td><?php echo $day3[1]; ?>%</td>
                                <td><?php echo $day4[1]; ?>%</td>
                                <td><?php echo $day5[1]; ?>%</td>
                            </tr>
                            <tr>
                                <td><?php echo $today[2]; ?>%</td>
                                <td><?php echo $yesterday[2]; ?>%</td>
                                <td><?php echo $day3[2]; ?>%</td>
                                <td><?php echo $day4[2]; ?>%</td>
                                <td><?php echo $day5[2]; ?>%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© 2020 Copyright <b>Filip Chudiak</b></p>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function () {
                $('#show').load('home.php');
            }, 30000);
        });
    </script>   

</body>

</html>