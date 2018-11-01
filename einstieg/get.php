<?php
$colors = [
    'default' => '#FFF',
    'dark' => '#444444',
    'medium' => '#CCC',
    'light' => '#EAEAEA'
];

// Wenn bc vorhanden, dann in $bc schreiben. Der Key der Farbe wird gespeichert
$bc = $_GET['bc'] ?? 'default';

// Falsche Farben abfangen
if (!array_key_exists($bc, $colors)) {
    $bc = 'default';
}
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Superglobals - GET</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<!-- Kurzform für php echo  -->
<body style="background-color: <?= $colors[$bc] ?>">
    <div class="container">
        <header class="site-header">
            <h1>Superglobals - GET</h1>
        </header>
        <main>
            <!-- Emmet: button.pure-button.pure-button-primary -->
            <a href="get.php?bc=dark"class="pure-button pure-button-primary">Dunkel</a>
            <a href="get.php?bc=medium"class="pure-button pure-button-primary">Mittel</a>
            <a href="get.php?bc=light"class="pure-button pure-button-primary">Hell</a>
        <?php
            /* 
                $_GET erlaubt es, über die URL, Name - Wert Paare weiter
                zu geben.
            */
            // Der Default Zustand einer Variable, die mit $_GET befüllt wird, wird gesetzt.

            $vn = '';
            /* 
                Zwei Bedingungen gleichzeitig prüfen:
                && - UND, and
                || - ODER, or
            */
            if (!empty($_GET) && array_key_exists('vn', $_GET)) {
                $vn = $_GET['vn'];
            }

            // Seit PHP 7: null coalescing operator
            // Existiert die Variable vor dem ?? nicht, wird der Wert nach dem ?? zugewiesen
            // if - else
            $nn = $_GET['nn'] ?? '';

            echo '<p> Vorname: ' . $vn . '</p>';
            echo '<p> Nachname: ' . $nn . '</p>';
        ?>
        </main>
    </div>
</body>
</html>