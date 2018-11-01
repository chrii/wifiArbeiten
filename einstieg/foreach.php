<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Die foreach Schleife</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
</head>
<body>
    <h1>Die foreach Schleife</h1>
    <?php
    $tiere = ['Hunde', 'Mäuse', 'Affen', 'Gorillas', 'Zebras'];
    $stammdaten = [
        'vorname' => 'Thomas',
        'nachname' => 'Macher',
        'alter' => 28,
        'e-mail' => 'bla@bla.com'
    ];
    /* 
        Die foreach Schleife erlaubt es uns auf alle Werte eines Arrays
        atomatisch zuzugreifen.

        Sie exisitiert in zwei Varianten: 
        nur den Wert jedes Eintrags auslesen
        Key und Wert jedes Eintrags auslesen

        foreach ($array as $wert) {

        }
    */
    sort($tiere);
    // Variante 1: Für jeden Eintrag steht in der Schleife der Wert in $value zur Verfügung
    foreach ($tiere as $value) {
        echo $value;
        echo '<br>';
    }
    
    // Variante 2: Für jeden Eintrag steht in der Schleife der Key in $key und der Wert in $value zur Verfügung
    foreach ($stammdaten as $key => $value) {
        echo "$key: $value";
        echo '<br>';
    }

    // $tiere in einer unordered list ausgeben
    echo '<ul>';
    foreach ($tiere as $value) {
        echo "<li>$value</li>";
    }
    echo '</ul>';

    // Stammdaten in Tabelle ausgeben
    echo '<table border="1">';
    foreach ($stammdaten as $key => $value) {
        echo '<tr>';
        echo "<th>$key</th>";
        echo "<td>$value</td>";        
        echo '</tr>';
    }
    echo '</table>';

    ?>
</body>
</html>