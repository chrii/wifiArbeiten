<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klicks zählen</title>
</head>
<body>
<?php
    session_start();
    $clicked = $_GET['clicked'] ?? '';

    $klickEins = $_SESSION['klickEins'] ?? 0;
    $klickZwei = $_SESSION['klickZwei'] ?? 0;
    $klickDrei = $_SESSION['klickDrei'] ?? 0;

    if ($clicked == 1) {
        // hoch zählen
        $klickEins++;
        // in Sesson merken
        $_SESSION['klickEins'] = $klickEins;        
    }
    elseif ($clicked == 2) {
        $klickZwei++;
        $_SESSION['klickZwei'] = $klickZwei;
    }
    elseif ($clicked == 3) {
        $klickDrei++;
        $_SESSION['klickDrei'] = $klickDrei;
    }
?>
<ul>
    <li><a href="?clicked=1">Eins</a> wurde <?= $klickEins ?> mal geklickt</li>
    <li><a href="?clicked=2">Zwei</a> wurde <?= $klickZwei ?> mal geklickt</li>
    <li><a href="?clicked=3">Drei</a> wurde <?= $klickDrei ?> mal geklickt</li>
</ul>
</body>
</html>