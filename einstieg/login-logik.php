<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Logik</title>
    <style>
    .success {
        color: #090;
    }

    .error {
        color: #900;
    }
    </style>
</head>
<body>
    <h1>Login Logik</h1>

    <?php
    // In realer Umgebung werden diese aus einer DB ausgelesen
    $username = 'tom';
    $password = '4321';

    // Würde aus einem Formular kommen
    $inputUsername = 'tom';
    $inputPassword = '4321';

    /* 
        Vergleichsoperatoren:
        es wird die linke Seite einer Bedingung mit deren rechter Seite verglichen
        a == b          a gleich b? Auch bei Zeichenketten verwendbar
        a != b          a nicht gleich (ungleich) b? Auch bei Zeichenketten verwendbar
        a > b           a größer b?
        a < b           a kleiner b?
        a >= b          a größer oder gleich b? (mindestens)
        a <= b          a kleiner oder gleich b? (höchstens)
    */
    // Ist der Benutzername richtig?
    if ($username == $inputUsername) {
        // JAAAAA
        // Ist auch das Passwort richtig?
        if ($password == $inputPassword) {
            // JAAAAA
            echo '<div class="success">Jipie!</div>';
        }
        else {
            // Nein
            echo '<div class="error">Uijeh Password!</div>';
        }
    }
    else {
        // Nein
        echo '<div class="error">Uijeh Username!</div>';
    }
    ?>
</body>
</html>