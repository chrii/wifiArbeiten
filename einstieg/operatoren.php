<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Operatoren</title>
</head>
<body>
    <?php
    /* 
        Logische Operatoren verknüpfen mehrere Bedingungen miteinander
        || bzw. or - eine der beiden Bedingungen muss true ergeben
        && bzw. and - beide Bedingungen müssen true ergeben

        ansonsten false
    */
    $a = 100;
    $b = 300;

    if ($a > 90 && $b < 500) {
        echo 'jipie';
    }

    // Ist Wert zwischen einschließlich 100 und einschließlich 150
    if ($a >= 100 && $a <= 150 ) {
        echo 'Jipie';
    }


    if ($a < 100 || $b > 200) {
        echo 'Jipie';
    }

    /* 
        diverse Kurzformen
    */
    $c = 1;
    $c = $c + 1; // Langform
    $c += 1;     // Kurzform 1 -> kann um beliebigen Wert erhöht werden $c += 12;
    $c++;        // Kurzform 2

    $c = $c - 1;
    $c -= 1;
    $c--;

    $c = $c * 2;
    $c *= 2;

    $c = $c / 2;
    $c /= 2;

    $d = 'Hallo ';
    $e = 'Roxanna';

    // Strings verknüpfen
    $d = $d . $e;   // Langform
    $d .= $e;       // Kurzform

    $farben = ['rot', 'blau'];
    $index = 0;
    
    for ($i = 0; $i < 10; $i++) {
        echo '<br>';
        // abwechselnd die Farben ausgeben
        echo $farben[$index];
        // Langform
        /* if ($index == 0) {
            $index = 1;
        }
        else {
            $index = 0;
        } */
        // Kurzform
        $index = 1 - $index;
    }


    ?>
</body>
</html>