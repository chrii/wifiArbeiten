<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cookies und Sessions</title>
</head>
<body>
<?php
    require_once '../lib/helpers.php';

    dump($_COOKIE);
    // Cookies werden mit setcookie gesetzt. Der optionale dritte Parameter ermöglicht den Zeitpunkt des Ablaufens des Cookies zu setzen: time() + 60*60*24*20 => Sekunden bis zum aktuellen Zeitpunkt plus Sekunden pro Tag * Tage bis zum Ablaufen
    setcookie('username', 'Harry.Potter', time() + 60*60*24*3);
    echo $_COOKIE['username'];

    /* 
        Sessions ermöglichen das Speichern von Daten im Sessions Array ($_SESSION).
        Dieses wird am Server gespeichert.
        Damit Sessions verwendet werden können, müssen wir diese zuers starten. Das sollte vor der ersten Ausgabe eines Inhalts bzw. Verwendung der Session geschehen.
    */
    session_start();

    // Auto logout nach 5 Sekunden
    $limit = 5; // nach 5 sek ausloggen
    $now = time();
    /* 
        entweder bereits gesetzten Wert von lastRequest auslesen,
        oder auf 0 setzen
    */
    $lr = $_SESSION['lastRequest'] ?? 0;

    /* 
        Wenn zwischen $now und $lr (lastRequest) mehr als $limit Sekunden vergangen sind, setze login auf false
    */
    if ($now - $lr > $limit) {
        $_SESSION['loggedIn'] = false;
    }

    // lastRequest bei jedem Aufruf auf den aktuellen Zeitpunkt setzen
    // Muss NACH dem Vergleich geschehen
    $_SESSION['lastRequest'] = $now;
    
    // Sessions werden wie ein Array verwendet. Sie sind gültig, bis das Browserfenster geschlossen wurde.
    // Sessions stellen mir ein Request übergreifendes Gedächtnis zur Verfügung
    $user = $_GET['user'] ?? '';
    if ($user == 'tom') {
        $_SESSION['loggedIn'] = true;
    }
    dump($_SESSION);
?>
    
</body>
</html>