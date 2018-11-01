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
            echo "<li>";
            echo "1 x $reihe = ";
            echo 1 * $reihe;
            echo "</li>";

            echo "<li>";
            echo "2 x $reihe = ";
            echo 2 * $reihe;
            echo "</li>";
            
            echo "<li>";
            echo "3 x $reihe = ";
            echo 3 * $reihe;
            echo "</li>";
        ?>
    </ul>
</body>
</html>