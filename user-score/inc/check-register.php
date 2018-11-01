<?php
// post prüfen
if (!empty($_POST)) {
    $errors = [];
    $gump = new GUMP('de');

    // Validierungen bekannt geben
    $gump->validation_rules(
        [
            'username' => 'required|min_len,3|max_len,255',
            'password' => 'required|min_len,8|max_len,255',
            'email' => 'required|valid_email'
        ]
    );

    $validData = $gump->run($_POST);


    if ($_POST['password'] !== $_POST['passwordConfirm']) {
        $validData = false;
        $errors['confirm'] = 'Bitte füllen Sie dieses Feld aus.';

    }
   
    if ($validData === false) {
        // Fehler ausgeben
        // String mit den Fehlern.
        $errors['gumpError'] = $gump->get_readable_errors(true);
        // Name Value Pairs zu feldern mit den Fehlern
        var_dump($errors);
    }
    else {
        $db = new SpiderDB($host, $user, $password, $database);
        $user = new User($db);
        $user->register($_POST['username'], $_POST['password'] , $_POST['email']);
    }
 
}