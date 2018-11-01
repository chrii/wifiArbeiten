<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bedingungen - die if Anweisung</title>
</head>
<body>
    <h1>Bedingungen - die if Anweisung</h1>
    <?php
    // Betrag zur Verfügung
    $betrag = 80;
    $kostenSchuhe = 40;

    // Nachsehen, ob ich mir die Schuhe leisten kann
    /* 
        Ein if stellt eine Bedingung, die true oder false ergibt.
        Ergibt sie true, wird der darauf folgende Block ausgeführt (geschwungene
        Klammern)
        $kostenSchuhe <= $betrag
        $betrag >= $kostenSchuhe

        Auch das false kann ausgewertet werden: über else
        else wird ausgeführt, wenn die Bedingung false ergibt. Else ist optional.
    */
    if ($kostenSchuhe <= $betrag) {
        echo 'Jipie!';
    }
    else {
        echo 'Na geh!';
    }
    ?>
</body>
</html>