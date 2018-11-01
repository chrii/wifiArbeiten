<?php require_once 'inc/init.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kunden-Details</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <?php
    $cid = $_GET['cid'] ?? 0;
    // TODO: check cid auf integer, ansonsten sql nicht auführen!
    $sql = "SELECT * FROM customers WHERE customerNumber=$cid";

    $result = $conn->query($sql);

    if ( $result !== false && $row = $result->fetch_assoc() ):
    ?>
    <h1>Kundendetails: <?= $row['customerName'] ?></h1>

    <table class="pure-table pure-table-striped">
        <tr>
            <th>Kontakt</th>
            <td><?= $row['contactFirstName'], ' ', $row['contactLastName']?></td>
        </tr>
        <tr>
            <th>Telefon</th>
            <td><?= $row['phone'] ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?= $row['addressLine1'], 
                    ' ',
                    $row['addressLine2'],
                    ', ',
                    $row['postalCode'],
                    ' ',
                    $row['city'],
                    ' ',
                    $row['state'],
                    ', ',
                    $row['country']
            ?></td>
        </tr>
        <tr>
            <th>Kreditlimit</th>
            <td><?= $row['creditLimit'] ?></td>
        </tr>
    </table>
    
    <?php 
    else:
        echo var_export($conn);
    endif; 
    ?>

</body>
</html>