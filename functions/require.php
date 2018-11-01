<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Dateien einbinden</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
<div class="container">
    <header class="site-header">
        <h1>PHP Dateien einbinden</h1>
    </header> 
    <main>
        <h2>include, include_once, require, require_once</h2>
        <?php
        // PHP kann jederzeit beliebige weitere PHP Dateien hinzuladen
        require '../lib/helpers.php';

        $arr = ['Rosen', 'Tulpen', 'Zyklamen', 'Orchideen'];
        dump($arr);

        
        ?>
    </main>
</div>
</body>
</html>