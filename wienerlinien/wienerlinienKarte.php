<?php
require_once 'lib/WienerLinienWebKit.php';



// Auslagern? -> Punkt in Kanban
$file = file_get_contents('json/allLines.json', 'r');

$data = json_decode($file);
$metroData = $data->lineData->ubahn;
$bimData = $data->lineData->bim;
$busData = $data->lineData->postBus;

$fileDate = $data->timeStamp;
$fileDateF = strtotime($fileDate);


// muss noch ausgelagert werden
// im Kanban für Echtzeit API
if (strtotime($fileDateF) > strtotime('+30 day')) {
    $haltestellen = fopen('https://data.wien.gv.at/csv/wienerlinien-ogd-haltestellen.csv', 'r');
    $linien = fopen('https://data.wien.gv.at/csv/wienerlinien-ogd-linien.csv', 'r');
    $steige = fopen('https://data.wien.gv.at/csv/wienerlinien-ogd-steige.csv', 'r');

    $wienerlinien = new WienerLinienWebKit($haltestellen, $linien, $steige);
    $wienerlinien->getLineToJson('ptBusNight', 'json/nightline.json');
    $wienerlinien->getAllToJson('json/allLines.json');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="javascript/jquery-3.3.1.min.js"></script>
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <script src="javascript/map.js"></script>
    <link rel="stylesheet" href="layout/materialize.css">
    <script src="layout/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="layout/layout.css">
    
    <title>Wiener Linien Service</title>
</head>
<body>
    <main class="container">
        <div id="map">

        </div>
        <div id="content">
            <section id="balken1">
                <a class='dropdown-trigger btn indigo darken-2' href='#' data-target='dropdownMetro'><i class="material-icons right">directions_subway</i>U Bahnen</a>
                <ul id='dropdownMetro' class='dropdown-content'>
                    <?php 
                        foreach($metroData AS $metroKey => $metroVal) {
                            echo '<li>' . $metroKey . '</li>';
                        }
                    ?>
                </ul>
                <a class='dropdown-trigger btn indigo darken-2' href='#' data-target='dropdownBus'><i class="material-icons right">directions_bus</i>Busse</a>
                <ul id='dropdownBus' class='dropdown-content'>
                    <?php 
                        foreach($busData AS $busKey => $busVal) {
                            echo '<li>' . $busKey . '</li>';
                        }
                    ?>
                </ul>
                <a class='dropdown-trigger btn indigo darken-2' href='#' data-target='dropdownBim'><i class="material-icons right">directions_railway</i>Straßebahnen</a>
                <ul id='dropdownBim' class='dropdown-content'>
                    <?php 
                        foreach($bimData AS $bimKey => $bimVal) {
                            echo '<li>' . $bimKey . '</li>';
                        }
                    ?>
                </ul>
            </section>
            <section id="balken2">

            </section>
        </div>
    </main>
    
</body>
</html>