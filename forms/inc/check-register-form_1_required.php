<?php
$formFields = [
    // nur required
    'vorname' => true,
    'nachname' => false
];

/* 
    Formular validieren
*/
if (!empty($_POST)) {
    echo export($_POST);
    foreach($formFields as $fieldName => $val) {
        /* 
            Null coalescing operator: wenn $fieldName nicht in POST: '' als Wert
            if / else Kurzform
            Wert des abgeschickten Feldes auslesen.
        */
        $fieldVal = $_POST[$fieldName] ?? ''; 
        $fieldOK = false;
        
        // Required prüfen?
        if ($val == true) {
            $fieldOK = checkRequired($fieldVal);
        }
        else {
            $fieldOK = true;
        }
        dump($fieldOK);
    }
}