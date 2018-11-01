<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ein mal eins</title>
</head>
<body>
    <h1>Die Zweier Reihe</h1>
    <ul>
        <?php
            $reihe = 2;
            /*  echo "<li>";
            echo "1 x $reihe = ";
            echo 1 * $reihe;
            echo "</li>"; */

            for ($i = 1; $i <= 10; $i = $i + 1) {
                
                /* 
                Ursprüngliche Lösung
                echo '<li>';
                // HTML Entity für Multiplizieren
                echo "$i &times; $reihe = ";
                echo $i * $reihe;
                echo '</li>'; */
                $product = $i * $reihe;
                echo "<li>$i &times; $reihe = $product </li>";
            }
        ?>
    </ul>
</body>
</html>