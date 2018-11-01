<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fantasy</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <style>
    body {
        padding: 2em;
    }
    </style>
</head>
<body>
   <h1>Fantasy OO</h1> 
   <?php
    require_once 'Fantasy/Character.php';
    require_once 'Fantasy/Orc.php';
    require_once 'Fantasy/Dwarf.php';
    
    $orcs = [];
    for ($i = 1; $i <= 10; $i++) {
        $neuerName = 'Orc ' . $i;
        $orcs[] = new Orc($neuerName, 'Axt');
    }
    //echo $orcs[0]->say('hallo');
    echo $orcs[0]->shout();

    $dwarf1 = new Dwarf('Sleepy', 10);
    echo $dwarf1->sing();
   
   
   
   
   
    /* $orc = new Orc('Ignaz', 'Club');
    echo $orc->say('Hallo!'); */

   /*  $textOutside = 'Jipie';
    echo $textOutside;
    bla('Juhu');

    function bla($text) {
        // $text = 'Juhu';
        echo $textOutside;
    } */
   ?>
</body>
</html>