<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Die For Schleife</title>
</head>
<body>
    <h1>Die for-Schleife (Zählschleife)</h1>
    <ul>
    <?php
    /* 
        for (Initialisierung; Bedingung; Zähler) {
            ... auszuführender Code
        } // Ende der Schleife

        - Nur beim ersten Durchlauf: Initialisierung
        - Alle weiteren Durchläufe
            - Bedingung - wenn sie true ergibt, wird der Schleifenblock ausgeführt
            - Bedingung - wenn sie false ergibt, wird die Schleife beendet.
            - nach Ausführen des Codeblocks wird der Zähler ausgeführt
            - Sprung in die Bedingung, Schleife wiederholt sich ...
    */
    for ($i = 0; $i <= 9; $i = $i + 1) {
        echo "<li>$i</li>";
    }
    ?>
    </ul>
</body>
</html>