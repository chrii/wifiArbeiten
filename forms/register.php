<?php
    require_once '../lib/helpers.php';
    require_once 'inc/check-register-form.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Functions</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
<div class="container">
    <header class="site-header">
        <h1>Registrierung</h1>
    </header> 
    <main>
        <?php
        if (!empty($errors)) {
            echo '<ul class="form-errors">';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
        }

        if ($formOK) {
            require 'contents/register-ok.php';
        }
        else {
            require 'contents/register-form.php';          
        }
        ?>
    </main>
</div>
</body>
</html>