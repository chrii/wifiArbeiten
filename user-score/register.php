<?php
    require_once 'inc/init.php';
    require_once 'inc/check-register.php';

    if (!empty($validData)){
        require_once 'login.php';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tetris - Übersicht</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>

<div class="container">
    <header class="site-header">
        <h1>Tetris</h1>
    </header> 
    <main>
        <h2>Registrieren</h2>
            <?php if (!empty($errors)): 
            //TODO: Besseres Errorhandling 
            ?>
                <p class="error">Ein Fehler ist aufgetreten</p>
            <?php endif; ?>
        <form action="" method="post" class="pure-form pure-form-stacked">
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <label for="userName">Username</label>
                    <input type="text" name="username" id="userName">

                    <label for="eMail">E-Mail</label>
                    <input type="email" name="email" id="eMail">
                </div>
                
                <div class="pure-u-1-2">
                    <label for="passWord">Passwort</label>
                    <input type="password" name="password" id="passWord">
                    
                    <label for="passWordConfirm">Passwort besätigen</label>
                    <input type="password" name="passwordConfirm" id="passWordConfirm">
                </div>
            </div>
            <p><input type="submit" value="Senden" class="pure-button pure-button-primary"></p>
        </form>
        
    </main>
</div>

</body>
</html>