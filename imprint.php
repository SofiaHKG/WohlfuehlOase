<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./res/css/stylesheet.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <img src="./res/img/bglib.jpg" class="image">
    <header>
        <div class="container jumbotron">
            <h1 class="display-1">Imprint</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="imprint">

                <h4>Company</h4>
                <p>Fictional Webtech Company</p>
                <h4>UID number</h4>
                <p>UID number: ATU2022-2187</p>
                <h4>Company book number</h4>
                <p>YT-1300</p>
                <h4>Corporate Registry Court</h4>
                <p>Archived Court: Vienna</p>
                <h4>Corporate seat</h4>
                <p>1200 Vienna</p>
                <h4>Full geographic address</h4>
                <p>Hoechstaedtplatz 6 | Vienna | Austria</p>
                <h4>Phone</h4>
                <p><a href="tel:+43155571138">+43 1 555 711 38</a> </p>
                <h4>email</h4>
                <p><a href="mailto:office@vehiclearchives.dev">office@vehiclearchives.dev</a></p>
                <h4>Professional title</h4>
                <p>Web archiver</p>
                <h4>Supervisory Board</h4>
                <div class="container">
                    <div class="row">
                        <div class='col-sm-3'></div>
                        <div class='col-sm-3'>
                            <div class='card'>
                                <img src="./res/img/amanda.jpg" alt="Julia"></a>
                                <div class='card-body board'>
                                    <p class='card-text navcenter'>Julia Pabst</p>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-3'>
                            <div class='card'>
                                <img src="./res/img/john.jpg" alt="Sofia"></a>
                                <div class='card-body board'>
                                    <p class='card-text navcenter'>Sofia Ginalis</p>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php
        include 'footer.php';
    ?>

</body>
</html>