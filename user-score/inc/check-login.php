<?php
$db = new SpiderDB($host, $user, $password, $database);
$user = new User($db);


$username = $_POST['username'] ?? '';
//$username = 'hallo';
$password = $_POST['password'] ?? '';
//$password = '12345678';
$errors = [];

// Fragt ob die Post da ist
if (!empty($_POST)){
    // Fragt ob in der Post ein Username und ein Password ist
    if (!empty($username) && !empty($password)){
        $dbUser = $user->login_db($username);
        if ($dbUser['username'] === $username && $dbUser['password'] === $password){
            $_SESSION['loggedIn'] = true;
        } else {
            $errors['pw'] = 'Username oder Passwort nicht korrekt';
            $_SESSION['loggedIn'] = false;
        }
    } else {
        // Wird ausgeführt sollte Username oder Password ein Leerstring sein 
        $errors['empty'] = 'Bitte füllen Sie beide Felder aus';
    }
}

/**
 * 
 *       user->login gibt für passendes User<->Password Kombination entweder True oder False zurück
 *       $_SESSION['loggedIn'] = $user->login($username, $password);
 *       $_SESSION['username'] = $username;
 *       $loginOk = true;
 *       $user->error gibt eine Fehlermeldung zurück 
 *       $errors['notOk'] = $user->error;
 */