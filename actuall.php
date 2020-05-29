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
            padding-top: 10px;
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
                <a class="nav-link" id="home-tab" href="home.php" role="tab">Domov</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" href="graph.php" role="tab">Grafy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" href="#contact" role="tab" aria-controls="contact"
                    aria-selected="true">Vypis</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="chart-container">
                        <div id="graph"></div>
                    </div>
                </div>
                <div class="col">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Teplota</th>
                            <th scope="col">Svietivosť</th>
                            <th scope="col">Vlhkosť</th>
                            <th scope="col">Čas</th>
                        </tr>
                        </thead>
                        <tbody id="show">
                        </tbody>
                    </table>
                </div>
            <div>
            </div>
        </div>

    </div>

    <div class="footer">
        <p>© 2020 Copyright <b>Filip Chudiak</b></p>
    </div>

    <script src="actuall_graph.js"></script>

    <script type="text/javascript">
        $('#show').load('data.php');
        $(document).ready(function() {
            setInterval(function () {
                $('#show').load('data.php')
            }, 1000);
        });

    </script>
    
</body>

</html>