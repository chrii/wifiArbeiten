<?php
require_once 'inc/init.php';
require_once 'inc/check-login.php';
//$_SESSION['loggedIn'] = true;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tetris - Übersicht</title>
        <link rel="stylesheet" href="css/layout.css">
    </head>
    <body>
        <div class="container">
            <header class="site-header">
                <h1>Tetris</h1>
            </header> 
            <main>
                <div class="pure-menu pure-menu-horizontal">
                    <a href="index.php" class="pure-menu-heading pure-menu-link">Home</a>
                    <ul class="pure-menu-list">
                        
                        <li class="pure-menu-item"><a href="register.php" class="pure-menu-link">Registrieren</a></li>
                        
                        <li class="pure-menu-item"><a href="game.php" class="pure-menu-link">Spiel</a></li>
                    </ul>
                </div>
                <?php 
                if ($user->loggedIn($_SESSION) === true){
                    require_once 'game.php';
                } else {
                    require_once 'login.php';
                }
                ?>
            </main>
</div>

</body>
</html>