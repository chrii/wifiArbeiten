<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OO Einstieg</title>
</head>
<body>
    <?php
    require_once 'inc/Kaffeemaschine.php';
    require_once '../lib/helpers.php';

    /* 
        Objekte erstellen
        Über das Schlüsselswort new und den Klassennamen wird ein neues
        Objekt der angegebenen Klasse erstellt. Es können beliebig viele erstellt werden. Jedes dieser Objekte bzw. Objektinstanzen ist eine 
        unabhängige Kaffeemaschine. 
    */
    $km = new Kaffeemaschine('Arabica', 220, 'Hochqellwasser');
    // Die Variable $km steht nun für das erstellte Objekt. Methoden und Attribute werden über den Objektzugriffsoperator verwendet.
    echo $km->machKaffee();

    $km1 = new Kaffeemaschine();
    //$km1->kaffee = 'Kakao';
    // Wenn Attribute public sind, dann können diese auch gesetzt werden. Dies ist nicht immer erwünscht.
    // $km1->strom = '1200V';
    $km1->setKaffee('Robusta');
    echo $km1->machKaffee();
    
    ?>
</body>
</html>