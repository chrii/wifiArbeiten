<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MySQL Einstieg</title>
</head>
<body>
    <h1>Einstieg in MySQL</h1>
    <?php
    require_once 'inc/init.php';

    // SQL Statement erstellen
    $sql = 'SELECT rechnungen.produkt, rechnungen.betrag, kunden.vorname, kunden.nachname FROM rechnungen, kunden WHERE rechnungen.kunden_id = kunden.id';

    $result = $conn->query($sql);

    // Wenn wir ein gültiges Result erhielten und mindestens eine Zeile zurück bekamen - num_rows = Anzahl der gefundenen Datensätze
    if ($result !== false && $result->num_rows > 0) {
        // merken, ob header schon ausgegeben wurde
        $hasHeader = false;
        echo '<table border="1">';
        
        while ($row = $result->fetch_assoc()) {
            // header ausgeben, wenn $isHeader false ist
            if ($hasHeader == false) {
                echo '<tr>';
                foreach($row as $key => $value) {
                    echo '<th>', ucfirst($key), '</th>';
                }
                echo '</tr>';
                // merken, dass header ausgegeben wurde
                $hasHeader = true;
            }
           
            echo '<tr>';
            
            foreach($row as $value) {
                echo "<td>$value</td>";
            }

            echo '</tr>';
        }
        
        
        
        echo '</table>';
    }
    ?>
</body>
</html>