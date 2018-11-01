<?php
require_once '../SpiderLib/SpiderDB.php';
echo '<pre>';
$db = new SpiderDB('localhost', 'root', '', 'classicmodels');

if ($db->getError() !== '') {
    echo 'Connection Fehler!' . $db->getError();
}

$result = $db->query('SELECT * FROM customers');
if ($result !== false) {
    while($row = $result->fetch_assoc()) {
        //var_export($row);
    }
}

$demo = 'SELECT * FROM customers WHERE city=? AND addressLine2=?';

$haystack = ['Auckland', 'Level 2'];

echo str_replace(['?'], $haystack, $demo);
echo "\n";
echo vsprintf('SELECT * FROM customers WHERE city=%s AND addressLine2=%s', $haystack);

echo "\n";
$str = 'xxxx ? xx ? xxx xxxxx x ? xxxx';
$a = 1;
$b = 2;
$c = 3;

$parts = explode('?', $str);
$final = $parts[0] . $a . $parts[1] .  $b . $parts[2] . $c . $parts[3];
echo $final;

$text = 'xxx a xxx b xxxx c';
echo "\n" . str_replace(['?', '?', '?'], [$a, $b, $c], $str);
 
echo '</pre>';