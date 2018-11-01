<?php require_once 'inc/init.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classic Models</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <h1>Classic Models</h1>
    <?php
    /* 
        Sortierung: Nach Angabe der Tabellen, WHERE etc. ORDER BY spalte1 ASC, spalte2 DESC, ...
        Default ASC

        Bei eindeutigen Spaltennamen muss der Tabellenname nicht vorangestellt 
        werden. Ist ein Name in mehreren Tabellen ident, muss der Tabellenname
        vorangestellt werden.

        $sql = 'SELECT orderNumber, orderDate, status, orders.customerNumber,customerName FROM orders LEFT JOIN customers ON orders.customerNumber= customers.customerNumber ORDER BY orderDate ASC';

        ALIAS:
        SELECT 
            o.orderNumber, o.orderDate, o.status, o.customerNumber, c.customerName 
        FROM orders AS o 
        LEFT JOIN customers AS c 
        ON o.customerNumber = c.customerNumber 
        ORDER BY o.orderDate ASC;

    */
   

    $sql = 'SELECT orders.orderNumber, orders.orderDate, orders.status, orders.customerNumber, customers.customerName FROM orders LEFT JOIN customers ON orders.customerNumber = customers.customerNumber ORDER BY orders.orderDate ASC';

    $result = $conn->query($sql);

    if ($result !== false) {
        echo '<table class="pure-table pure-table-striped">';
        echo <<<HEAD
        <tr>
            <th>Nr.</th>
            <th>Datum</th>
            <th>status</th>
            <th>Customer</th>
        </tr>
HEAD;
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            // Geschwungene Klammern erlauben uns auch Arrrays in einen String zu setzen
            echo "<td><a href=\"order-details.php?oid={$row['orderNumber']}\">{$row['orderNumber']}</a></td>";
            echo "<td>{$row['orderDate']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td><a href=\"customer-details.php?cid={$row['customerNumber']}\">{$row['customerName']}</a></td>";
            
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
</body>
</html>