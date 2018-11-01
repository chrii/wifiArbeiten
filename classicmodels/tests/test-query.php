<?php
require_once '../SpiderLib/SpiderDB.php';
$user = 'root';
$password = '';
$host = 'localhost'; // 127.0.0.1
$db = 'classicmodels';

$db = new SpiderDB($host, $user, $password, $db);

echo $db->query('SELECT * FROM customers WHERE city=? AND addressLine2=?', ['Auckland', 'Level 2']);