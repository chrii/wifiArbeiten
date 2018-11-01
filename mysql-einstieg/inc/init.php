<?php
$user = 'root';
$password = '';
$host = 'localhost'; // 127.0.0.1
$db = 'sql_einstieg';

// DB Verbindung aufbauen
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error !== NULL) {
    // TODO: user-zentrierte Fehlermeldung
    die('Verbindungsfehler: ' . $conn->connect_error);
}