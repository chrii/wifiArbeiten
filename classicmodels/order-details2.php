<?php require_once 'inc/init.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rechnungsdetails</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>  
    <?php 
    $oid = $_GET['oid'] ?? 0;
    // Check auf Int
    if (ctype_digit($oid) === false) {
        die('Ungültige Anfrage');
    }
    /* 
        An jeder Stelle, an der ein Wert von außen an das Statement übergeben werden soll, setzen wir ein ? als Platzhalter.
    */
    $sql = <<<SQL
SELECT orderdetails.*, products.productName 
FROM `orderdetails` 
INNER JOIN products 
ON orderdetails.productCode = products.productCode 
WHERE orderdetails.orderNumber=?
ORDER BY orderLineNumber
SQL;

    /* 
        1. Statement vorbereiten
    */
    $stmt = $conn->prepare($sql);
    if(!$stmt) {
        die('Abfrage konnte nicht gesetzt werden.');
    }

    /* 
        2. Werte an dieParameter des Statements binden
           Die Parameter des Statement (?) verhalten sich wie Parameterlisten
           von Funktionen. Über $stmt->bind_param( ... ) werden die Werte in der
           Reihenfolge übergeben, wie die ? im Statement angegeben wurden
    */
    if($stmt->bind_param('i', $oid) === false) {
        die('Abfrageparameter konnten nicht gesetzt werden.');
    }

    /* 
        3. Ausführen des Stamtements
    */
    if ( $stmt->execute() !== false):
        /* 
            Bei $stmt->fetch() werden die Spaltenwerte automatisch in den
            gebundenen Variablen gespeichert.

            Für jedes Feld des result müssen Variablen in der entsprechenden 
            Reihenfolge zur Verfügung gestellt werden.

            "mit jedem $stmt->fetch() schreibe die Werte in folgende Variablen"
        */
       $result = $stmt->get_result();
    ?>
    <h1>Rechnung Nr: 10100</h1>
    <table class="pure-table pure-table-striped">
    <tr>
        <th>Produkt</th>
        <th>Preis</th>
        <th>Stück</th>
        <th>Gesamt</th>
    </tr>    
    <?php
    $total = 0;
    // fetch mit bind_result verwenden
    while ($row = $result->fetch_assoc()):
        $rowtotal = $row['priceEach'] * $row['quantityOrdered'];
        $total += $rowtotal;
        echo '<tr>';
        echo "<td>{$row['productName']}</td>";
        echo "<td>{$row['priceEach']}</td>";
        echo "<td>{$row['quantityOrdered']}</td>";
        echo "<td>$rowtotal</td>";
        echo '</tr>';
    endwhile;
    echo "<tr style=\"background: #EAEAEA\"><td colspan=\"3\">Summe:</td><td><strong>$total</strong></td></tr>";
    else:
        echo 'Ungültige Anfrage';
    ?>
    </table>
    <?php endif; ?>

    

</body>
</html>