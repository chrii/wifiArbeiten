<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Strings - Zeichenketten</title>
</head>
<body>
    <h1>Strings</h1>
    <?php
    // Strings werden unter einfache oder doppelte Anführungszeichen gesetzt.
    $name = 'Hanna';
    $frucht = "Melone";

    // Die einfachen Anführungszeichen lassen den String 'so wie er ist' ausgeben
    $zahl = 22;
    $out1 = 'Zahl = $zahl';
    // Unter doppelten Anführungszeichen wird der String ausgewertet, dh. er kann auch Variablen beinhalten. Deren Wert wird dann ausgegeben
    $out2 = "Zahl = $zahl";
    echo '<br>';
    echo $out1,  '<br>',  $out2, '<br>';

    // Zu beachten: spezielle Zeichen müssen unter doppelten Anführungszeichen 'escaped' werden. Dh. ein \ wird vorangestellt.
    // Der Backslash markiert ein Zeichen als auszugeben!
    $out1 = '<div style="color: red">Rot!</div>';
    $out2 = "<div style=\"color: blue\">Blau!</div>";

    echo '<br>', $out1,  '<br>',  $out2, '<br>';


    // Strings zusammensetzen
    $geld = 100;
    $name = 'Roberta';
    $waehrung = '€';
    /* echo $name;
    echo ' besitzt';
    echo ' ';
    echo $waehrung;
    echo ' ';
    echo $geld;
    echo ' ';
    echo ' an Geld!'; */
    $text = $name . ' besitzt ' . $waehrung . ' ' . $geld . ' an Geld!';
    echo $text;

    // HEREDOC
    /* 
        Entspricht dem String unter doppelten Anführungszeichen. 
        Es können längere Texte inklusive Einrückungen, Umbrüchen etc.
        auf einmal gesetzt werden.

        Ein Heredoc String beginnt mit <<< gefolgt von einem beliebigen Bezeichner. Dieser wird üblicher Weise in Großbuchstaben geschrieben.

        Beendet wird er, indem am Beginn einer Zeile der Bezeichner 
        wiederholt wird. ACHTUNG: Es darf in der selben Zeile davor
        kein Zeichen vorkommen (Tab, Space etc.)
    */
    $heredoc = <<<MEINTEXT
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
     Cupiditate magnam sequi maxime excepturi beatae voluptatem quaerat expedita pariatur "illo" quisquam dignissimos laboriosam fugit neque sunt, nobis tempore amet at voluptates!</p>
     lorem
    <p>$text</p>
    <ul>
        <li>hallo</li>
        <li>jippie</li>
        <li>$out1</li>
    </ul>
MEINTEXT;
    echo $heredoc;

    //NOWDOC
    $nowdoc = <<<'TEXT'
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda vero neque amet laudantium, debitis, consectetur dolores facere nostrum rem voluptas in autem dignissimos quidem, repellat dicta. Expedita earum provident repudiandae!</p>
    $text
TEXT;
    echo $nowdoc;


    // Strings und Arrays
    $laender = 'Deutschland,Frankreich,England,Spanien,Schweden';
    // explode macht anhand eines Trennzeichens (Delimiter) ein Array
    $arrLaender = explode(',', $laender);
    var_dump($arrLaender);

    sort($arrLaender);
    // Implode erzeugt aus einem Array einen String
    $sortedLaender = implode(', ', $arrLaender);
    echo "<br>$sortedLaender";    
?>
</body>
</html>