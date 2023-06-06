<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $Title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 450px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/users/logout"><span class="glyphicon glyphicon-log-in"></span>Вихід</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php //if ($_SESSION['user']['role'] === '3') { ?>
<!--    <p><a href="\student\about">Мої дані</a></p>-->
<!--    <p><a href="\student\courses">Мої Курси</a></p>-->
<!--    <p><a href="#">Успішність</a></p>-->
<?php //} else if ($_SESSION['user']['role'] === '2') { ?>
<!--    <p><a href="\teacher\about">Мої дані</a></p>-->
<!--    <p><a href="\teacher\courses">Мої Курси</a></p>-->
<!--    <p><a href="#">Статистика</a></p>-->
<?php //} else if ($_SESSION['user']['role'] === '1') { ?>
<!--    <p><a href="\admin\about">Мої дані</a></p>-->
<!--    <p><a href="\admin\courses">Курси</a></p>-->
<!--    <p><a href="\admin\courses">Студенти</a></p>-->
<!--    <p><a href="\admin\courses">Викладачі</a></p>-->
<?php //} ?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-1 text-left">

        </div>
        <div class="col-sm-10 text-left">
            <main>
                <?= $Content ?>
            </main>
        </div>
        <div class="col-sm-1 text-left">

        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>IPZ-19-1 Nikita Drzevetskyi</p>
</footer>

</body>
</html>