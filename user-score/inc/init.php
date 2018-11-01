<?php
/*
    spl_autoload_register kann beliebig viele Autoloader Funktionen registrieren.
    Wenn PHP jetzt auf einen neuen Klassennamen trifft und die Klasse
    noch nicht required wurde, wirft PHP vorerst keinen Fehler, sondern
    ruft alle autoload Funktionen auf, bis die entsprechende Klasse
    required/included wurde.

 */
// Autoloading: Name der Autoloader Funktion als String mitgeben
 /*spl_autoload_register('load_spiderLib');

function load_spiderLib(string $class) {
    echo '/SpiderLib/' . $class . '.php';
    require __dir__'SpiderLib/' . $class . '.php';
} */
require_once 'SpiderLib/SpiderDB.php';
require_once 'SpiderLib/User.php';
require_once 'SpiderLib/GUMP.php';

$user = 'root';
$password = '';
$host = 'localhost'; // 127.0.0.1
$database = 'tetris';

/*
// DB Verbindung aufbauen
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error !== NULL) {
    // TODO: user-zentrierte Fehlermeldung
    die('Verbindungsfehler: ' . $conn->connect_error);
} */
session_start();