<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Functions</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
<div class="container">
    <header class="site-header">
        <h1>Functions</h1>
    </header> 
    <main>
        <h2>Functions deklarieren</h2>
        <?php
        /*
            Funktionen können aufgerufen werden, bevor sie deklariert wurden.
            Bevor PHP den Code ausführt setzt es alle Funktionen an den Beginn.
        */
        simple();

        /* 
            Deklaration einer Funktion:
            Schlüsselwort function
            Name vergeben: a-z, A-Z, 0-9, _ (kein $ Zeichen!)
            in den runden Klammern werden die Parameter angegeben - optional
        */
        function simple () {
            echo '<p>Jipie</p>';
        }

        /* 
            Aufruf:
            eine Funktion kann beliebig oft aufgerufen werden.
        */
        simple();
        simple();
        simple();

        /* 
            Funktionsparameter werden bei der Deklaration durch Beistrich getrennt
            angegeben. Beim Aufruf müssen diese in der vorgegebenen Reihenfolge
            mit Werten versehen werden. Deshalb müssen Funktionen auch immer 
            dokumentiert werden.

            Parameter sind Variablen, die beim Aufruf mit mitgegebenen Werten 
            befüllt werden.

            Sie existieren nur innerhalb der Funktion bis diese beendet wird. 

            Von außen kann nicht darauf zugegriffen werden (außerhalb des Funktionsblocks).

            Funktionen sind black boxes, dh. wir haben keinen Zugriff auf
            ihr inneres funktionieren beim Aufruf.

            Sind Parameter deklariert MÜSSEN diese beim Aufruf mitgegeben werden.
            
        */
        // Gibt Text in einem Absatz aus, $text erwartet einen String
        function paragraph($text) {
            /* 
                Beispielaufruf:
                paragraph('Servus Thomas');
                Die Funktion befüllt beim Aufruf den Parameter $text mit dem mitgegebenen Wert: 
                $text = 'Servus Thomas';

            */
            echo "<p>$text</p>";
        }
        
        paragraph('Servus Thomas');
        paragraph('Na, wie geht es dir?');


        function gruss($grussWort, $text, $trenner) {
            echo "<p>$grussWort $trenner $text</p>";
        }

        gruss('Hallo', 'Pipi Langstrumpf', ',');
        gruss('Servus', 'Ron Weasly', ':');

        /* 
            Rückgabewerte:
            Eine Funktion kann ein Ergebnis nach außen liefern.
            mit Hilfe des Schlüsselworts return wir die Funktion beendet
            und ein Wert geliefert. 

            Dieser Rückgabewert kann nach Abarbeiten der Funktion weiter
            verwendet werden.
        */
        function add($a, $b) {
            return $a + $b;
        }
        // Die Funktion liefert den Wert 7, dieser kann z. B. ausgegeben werden.
        echo add(3, 4);
        // ... oder in einer Variable gespeichert werden.
        $summe = add(12, 33);
        echo '<br>';
        echo $summe;

        /* 
            Funktionen sollten:
            eine einzige Aufgabe erfüllen
            so wenig Parameter wie möglich, so viele wie nötig deklarieren (<= 4)
            kurz gehalten werden

            Wann schreibe ich eine Funktion:
            wenn der gleiche Prozess (mit unterschiedlichen Werten) öfter benötigt werden.

            DRY - Don't repeat yourself
        */
        // Bad practice 
        /* function rechne($zahl1, $zahl2, $rechenart) {
            if ($rechenart == '+') {
                return $zahl1 + $zahl2;
            }
            elseif ($rechenart == '-') {
                return $zahl1 - $zahl2;
            }
            elseif ($rechenart == '*') {
                return $zahl1 *$zahl2;
            }
            elseif ($rechenart == '/') {
                return $zahl1 / $zahl2;
            }
        } */

        // Besser
        // function add() ... ist oben definiert
        function subtract($zahl1, $zahl2) {
            return $zahl1 - $zahl2;
        }

        function multiply($zahl1, $zahl2) {
            return $zahl1 * $zahl2;
        }

        function divide($zahl1, $zahl2) {
            return $zahl1 / $zahl2;
        }

        function modulo($zahl1, $zahl2) {
            return $zahl1 % $zahl2;
        }

        // Good practice 
        function rechne($zahl1, $zahl2, $rechenart) {
            if ($rechenart == '+') {
                return add($zahl1, $zahl2);
            }
            elseif ($rechenart == '-') {
                return subtract($zahl1, $zahl2);
            }
            elseif ($rechenart == '*') {
                return multiply($zahl1, $zahl2);
            }
            elseif ($rechenart == '/') {
                return divide($zahl1, $zahl2);
            }
        }

        // Kleiner 100
        function kleiner100 ($zahl) {
            if ($zahl < 100) {
                return true;
            }
            else {
                return false;
            }
        }
        echo '<br>';
        var_dump( kleiner100(23) );
        var_dump( kleiner100(-200) );
        var_dump( kleiner100(5000) );

        // Zwischen
        function between($min, $max, $zahl) {
            if ($zahl >= $min && $zahl <= $max) {
                return true;
            }

            /* 
                else nicht nötig, da wenn obiges return ausgeführt wurde, die Funktion
                bereits beendet ist.
            */
            return false;
        }

        echo '<br>';
        var_dump( between(10, 20, 13) );
        var_dump( between(100, 200, 200) );
        var_dump( between(-40, -20, 10) );
        ?>

    </main>
</div>
</body>
</html>