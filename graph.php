<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Filip Chudiak</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Balsamiq+Sans?subset=latin">
    <script type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <style>
        body {
            background-image: url("Images/body2.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed; 
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
        
        .custom {
            background-color: #f4fafec9;
            text-align: center;
            width: 100px;
            height: 70px;
        }

        #select {
            height: 38px;
            width: 200px;
            padding-bottom: 3.5px;
            padding-left: 10px;
            border-radius: 5px;
            border: 1px solid #6c757d;
            color: #6c757d;
       }
    </style>
</head>

<body>
    
    <div class="jumbotron text-center">
        <h3>Meteostanica</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="home-tab" href="home.php" role="tab" >Domov</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="true">Grafy</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" href="actuall.php" role="tab">Vypis</a>
        </li>
    </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container">
                <div class="row" style="padding-top: 5px;">
                    <div class="col">
                        <form action="graph.php" method="post">
                            <button type="submit" id="dnes" name="dnes" value="dnes" class="btn custom" style="float: right;" target="dummyframe">Dnes</button>
                        </form>
                    </div>
                    <div class="col-2">
                        <form action="graph.php" method="post">
                            <button type="submit" id="vcera" name="vcera" value="vcera" class="btn custom" target="dummyframe">Včera</button>
                        </form>
                    </div>
                    <div class="col">
                        <form action="graph.php" method="post">
                            <button type="submit" id="3days" name="3days" value="3days" class="btn custom" style="float: left;" target="dummyframe">Posledné 3 dni</button>
                        </form>
                    </div>
                </div>
                <div class="row" style="padding-top: 5px;">
                    <div class="col">
                    </div>
                    <div class="col-6">
                    <form action="graph.php" method="post" style="padding-top: 20px;">
                        <input type="date" data-date="" data-date-format="DD MMMM YYYY" name="select" id="select" />
                        <input type="submit" class="btn btn-outline-secondary" name="submit" value="Vykresli" />
                    </form>
                    </div>
                    <div class="col">
                    </div>
                </div>

                <div class="chart-container">
                    <div id="graph"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="footer">
        <p>© 2020 Copyright <b>Filip Chudiak</b></p>
    </div>

</body>

</html>