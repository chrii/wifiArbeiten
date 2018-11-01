<?php
require '../inc/init.php';

$db = new SpiderDB($host, $user, $password, $database);
$user = new User($db);

$userOK = $user->register('theuser1', 'fjdlasl', 'tom@tom.at');
var_dump($userOK);
if (!$userOK) {
    echo $db->getError();
}