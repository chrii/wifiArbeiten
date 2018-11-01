<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Variablen</title>
</head>
<body>
    <h1>Variablen</h1>   
    <?php
        /* 
            Variablen sind benannte Behälter für sich ändernde (variable) Werte.
            An jeder Stelle, an der die Variable verwendet wird, wir der von
            ihr repräsentierte Wert gesetzt.

            Variablen beginnen mit $
            Erlaubte Zeichen: Muss mit einem Buchstaben oder _ beginnen (nach $)
            a-z A-Z 0-9 _

            Das erste Auftreten einer Variable nennt man Deklaration.
            Wird ihr das erste mal ein Wert zugewiesen, nennt man das 
            Initialisierung

            PHP ist case sensitive - dh. Groß und Kleinschreibung beachten.
        */
        $kontostand = 87000;
        echo $kontostand;
        
        echo '<br>';
        $kontostand = 90000;
        echo $kontostand;
        
        // Mit Variablen kann auch gerechnet werden
        echo '<br>';
        $kontostand = $kontostand - 350;
        echo $kontostand;

        echo '<h2>Zinsen</h2>';
        echo '<p>';
        $zinsen = $kontostand * 2 / 100;
        echo $zinsen;
        echo '</p>';
        echo $kontostand + $zinsen;
    ?>
</body>
</html>