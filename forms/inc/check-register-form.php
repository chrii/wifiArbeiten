<?php
/* 
    required: true/false    optional => false, wenn nicht angegeben
    dataType: verpflichtend:
        int
        text
        float
        boolean
        email
        date
        datetime
        html
        custom => regular expression, zusätzlich muss 
                  das Attribut regex gesetzt werden
    min: Zahl, Minimalwert, optional
    max: Zahl, Maximalwert, optional
    min_len: String, Mindestlänge, optional
    max_len: String, maximale Länge, optional
*/
$formFields = [
    // nur required
    'vorname' => [
        'required' => true,
        'dataType' => 'text',
        'min_len' => 2,
        'max_len' => 50
    ],
    'nachname' => [
        'required' => false,
        'dataType' => 'text',
        'min_len' => 2
    ]
];

// Speichert potentielle Fehlermeldungen für jedes einzelne Feld
$errors = [];
$formOK = false;

/* 
    Formular validieren
*/
if (!empty($_POST)) {
    foreach($formFields as $fieldName => $config) {
        /* 
            Null coalescing operator: wenn $fieldName nicht in POST: '' als Wert
            if / else Kurzform
            Wert des abgeschickten Feldes auslesen.
        */
        $fieldVal = $_POST[$fieldName] ?? ''; 
        $fieldOK = false;
        
        // Required prüfen
        if ($config['required'] == true && checkRequired($fieldVal) == false) {
            $errors[$fieldName] = "$fieldName muss ausgefüllt werden.";
            /* 
                Schleife beenden: break
                aktuellen Schleifendurchlauf beenden: continue - geht in den 
                nächsten Durchlauf
            */
            continue;
        } // ist das Feld nicht required und leer, dann ist alles ok, keine weitere Validerung nötig
        elseif (!$config['required'] && $fieldVal == '') {
            continue;
        }
        
        // Datentyp validieren
        $dataTypeOK = false;
        /* 
            switch - Ersatz für if/elseif/else
            Wird verwendet, wenn eine begrenzte Anzahl vor Werten für 
            eine Variable abgefragt werden kann.
        */
        switch ($config['dataType']) {
            /* 
                case:
                wenn $config['dataType] == 'text
            */
            case 'int':
                if (checkInt($fieldVal) == false) {
                    $errors[$fieldName] = "$fieldName muss eine Ganzzahl enthalten.";
                }
                else {
                    $dataTypeOK = true;
                }
            break; // switch beenden
            case 'float':
                if (checkFloat($fieldVal) == false) {
                    $errors[$fieldName] = "$fieldName muss eine Kommazahl enthalten.";
                }
                else {
                    $dataTypeOK = true;
                }
            break;
            case 'email':
                if (checkEmail($fieldVal) == false) {
                    $errors[$fieldName] = "$fieldName muss eine E-Mail Adresse enthalten.";
                }
                else {
                    $dataTypeOK = true;
                }
            break;
            default: 
                // wandelt 'gefährliche' Zeichen in HTML Special Characters um
                $fieldVal = htmlspecialchars($fieldVal);
                $dataTypeOK = true;
        }
        
        // Validierung beenden, wenn dataType einen Fehler warf.
        if(!$dataTypeOK) {
            continue;
        }

        // Min/Max Validierung
        $min = $config['min'] ?? ''; // vermeidet unbekannter Index, da optional
        $max = $config['max'] ?? '';
        $min_len = $config['min_len'] ?? '';
        $max_len = $config['max_len'] ?? '';

        // Wenn min & max angegeben sind, muss der Wert dazwischen liegen
        if ($min != '' && $max != '') {
            if ($fieldVal < $min || $fieldVal > $max) {
                $errors[$fieldName] = "$fieldName darf mindestens $min und höchstens $max sein.";
                continue;                
            }
        }
        
        // Zahl - Minimum
        if ($min != '') {
            if ($fieldVal < $min) {
                $errors[$fieldName] = "$fieldName muss mindestens $min sein.";
                continue;
            }
        }
        
        // Zahl - Maximum
        if ($max != '') {
            if ($fieldVal > $max) {
                $errors[$fieldName] = "$fieldName darf höchstens $max sein.";
                continue;
            }
        }


        // Zeichenkette Länge
        if ($min_len != '' && $max_len != '') {
            if (strlen($fieldVal) < $min_len || strlen($fieldVal) > $max_len) {
                $errors[$fieldName] = "$fieldName muss mindestens $min_len und höchstens $max_len Zeichen enthalten.";
                continue;                
            }
        }
        // Mindestlänge
        if ($min_len != '') {
            if (strlen($fieldVal) < $min_len) {
                $errors[$fieldName] = "$fieldName muss mindestens $min_len Zeichen enthalten.";
                continue;
            }
        }
        // Maximale Länge
        if ($max_len != '') {
            if (strlen($fieldVal) > $max_len) {
                $errors[$fieldName] = "$fieldName darf höchstens $max_len Zeichen enthalten.";
                continue;
            }
        }
    }

    if (empty($errors)) {
        $formOK = true;
    }
}
