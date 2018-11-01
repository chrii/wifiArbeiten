<?php
$errors = [
    'username' => '',
    'password' => ''
];

$loginOK = false;

// Prüfen, ob posted wurde (ist $_POST not empty)
if (!empty($_POST)) {
    echo export($_POST);

    // Hilfsvariablen
    $uname = $_POST['username'];
    $pw = $_POST['password'];
    // username ist false bis er bewiesen hat, dass er passt
    $unameOK = false;
    $pwOK = false;

    // required check
    if (checkRequired($uname)) {
        if ('tom' == $uname) {
            $unameOK = true;
        }
        else {
            // WICHTIG: Login Formulare sollten nur eine generelle Fehlermeldung ausgeben. Zu Übungszwecken geben wir verschiedene aus.
            $errors['username'] = '<p class="msg-error">Username nicht korrekt</p>';
        }
    }
    else {
        $errors['username'] = '<p class="msg-error">Username wurde nicht ausgefüllt</p>';
    }

    //Passwort prüfen
    if ($unameOK == true) {
        if (checkRequired($pw)) {
            if ('4321' == $pw) {
                $pwOK = true;
            }
            /*  TODO: löschen, wenn wir online gehen */
            else {
                $errors['password'] = '<p class="msg-error">Passwort nicht korrekt</p>';
            }
        }
        else {
            $errors['password'] = '<p class="msg-error">Passwort wurde nicht ausgefüllt</p>';
        }
    }

    // Nur wenn beide Felder valide sind, wird loginOK auf true gesetzt.
    if ($unameOK && $pwOK) {
        $loginOK = true;
    }
}