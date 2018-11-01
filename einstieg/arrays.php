<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arrays</title>
</head>
<body>
    <h1>Arrays</h1>
    <?php
    /* 
        Arrays speichern beliebig viele zusammenhängende Werte in einer Variable.
        Diese Werte können sortiert, ausgelesen, gelöscht, kurz - bearbeitet werden.

        Zwei Methoden zur Erstellung:
        mit der Funktion array( ... )
        Über die Kurzform [ ... ]

        Beim Erstellen wird das Array einer Variable zugewiesen.
        automatisch indizierte Arrays - jeder Werte erhält automatisch einen Index, beginnend bei 0.
    */
    $quartal = array(1, 2, 3, 4);
    // Alternativ
    $quartal = [1, 2, 3, 4];

    /*
        Werte auslesen
        Der Index (Key) wird in eckigen Klammern geschrieben, um auf einen
        bestimmten Wert zuzugreifen.
    */
    echo $quartal[1];
    echo '<br>';
    echo $quartal[3];
    
    // Hilfsfunktionen: var_dump, var_export
    echo '<br>';
    
    // Neuen Wert am Ende des Arrays hinzufügen
    $quartal[] = 12;
    $quartal[] = 23;
    $quartal[] = 9;
    
    
    echo '<pre>';
    var_export($quartal);
    echo '</pre>';
    
    $fruechte = ['Banane', 'Kiwi', 'Orange', 'Himbeeren', 'Apfel'];
    /* 
        sort  - aufsteigend sortieren
        rsort - absteigend sortieren (reverse)
    */
    sort($fruechte);
    
    
    echo '<pre>';
    var_export($fruechte);
    echo '</pre>';

    /* 
        assoziatives Array (Hashes)
        beliebiger Text kann als Index gesetzt werden
    */
    $stammdaten = array (
        'vorname' => 'Thomas',
        'nachname' => 'Macher',
        'alter' => 28,
        'e-mail' => 'bla@bla.com'
    );
    // Alternativ
    $stammdaten = [
        'vorname' => 'Thomas',
        'nachname' => 'Macher',
        'alter' => 28,
        'e-mail' => 'bla@bla.com'
    ];

    echo $stammdaten['e-mail'];

    // Eintrag hinzufügen:
    $stammdaten['bundesland'] = 'burgenland';

    echo '<pre>';
    var_export($stammdaten);
    echo '</pre>';
    
    /************ Fehlermöglichkeiten *************/
    // Bei automatischer Indizierung dürfen KEINE manuellen Indizes gesetzt werden
    $arr = ['Hallo', 'Jipie', 123];
    $arr[20] = 'Uijeh';
    
    echo '<pre>';
    var_export($arr);
    echo '</pre>';

    // Zugriff auf nicht existierende Elemente
    echo $stammdaten['land'];

    ?>
</body>
</html>