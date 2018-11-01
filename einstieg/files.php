<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Handling</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <div class="container">
        <header class="site-header">
            <h1>File Handling</h1>
        </header> 
        <main>
        <?php
        // Öffnen der Datei
        $file = fopen('data/customers.csv', 'r');

        // Immer prüfen, ob das file geöffnet werden konnte.
        if ($file != false) {
            // echo '<ol>';            
            /* 
                Die while Schleife, bedingte Schleife:
                Wie ein if, das so oft ausgeführt wird, bis die Bedingung false
                ergibt.

                Ein String wird in PHP als true gewertet, ein Leerstring false.
                Da fgets entweder einen String in $row speichert, ODER false,
                können wir die Zuweisung als Bedingung einfügen.
            */
           /*  while ( $row = fgets($file) ) {
                echo "<li>$row</li>";
            }

            echo '</ol>'; */
            echo '<table class="pure-table pure-table-bordered">';
            // Hilfsvariable, die Zeilen zählt
            $rowCounter = 1;

            while ( $row = fgets($file) ) {
                echo '<tr>';
                // Den String anhand des Komma teilen und in ein Array umwandeln
                $rowData = explode(',', $row);
                
                // Schleife über das Array, jeden Eintrag in ein td schreiben
                foreach($rowData as $value) {
                    // In der ersten Zeile th ausgeben, ansonsten td
                    if ( $rowCounter == 1 ) {
                        echo "<th>$value</th>";
                    }
                    else {
                        echo "<td>$value</td>";
                    }                   
                }                
                
                echo '</tr>';
                
                // $rowCounter = $rowCounter + 1;
                // Kurzform:
                $rowCounter++;
            }

            echo '</table>';
        }
        // Datei schließen, wird am Ende des PHP Scripts automatisch geschlossen.
        fclose($file); 
        ?>
        </main>
    </div>
</body>
</html>