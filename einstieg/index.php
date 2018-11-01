<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Einstieg</title>
</head>
<body>
    <h1>Einstieg in PHP</h1>
    <?php
        // Ein einzeiliger Kommentar
        /* 
            Mehrzeilige Kommentare
            erlauben mir, meinen Quelltext
            zu kommentieren. Kommentare 
            werden ignoriert.

            Kürzel: Strg + # einzeilig
            Alt + Shift + a mehrzeilig
        */
        // echo schreibt per PHP in die aktuelle Datei
        echo date('d.m.Y h:i:s');

        // PHP kann rechnen
        /* 
            7 + 4 ist ein Ausdruck
            ein Ausdruck (expression) wird
            ausgewertet. An Stelle des
            Ausdrucks wird das Ergebnis
            gesetzt. 
        */
        echo '<br>';
        echo 7 + 4;
        
        echo '<br>';
        echo 120 - 55;

        // Multiplikation
        echo '<br>';
        echo 12 * 7;

        // Division
        // ACHTUNG: Das Komma einer Zahl kommt aus dem Englischen und wird als Punkt geschrieben.
        echo '<br>';
        echo 17 / 13;
        ?>
</body> 
</html>