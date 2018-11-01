<?php

/**
 * formatiertes var_dump
 * 
 * @param mixed $val
 */
function dump($val) {
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
}

/**
 * formatiertes var_export
 * 
 * @param mixed $val
 * @return string
 */
function export($val) {
    $out = '';
    $out .= '<pre>';
    // zweiter Parameter true: String als Rückgabe, sonst wie echo
    $out .= var_export($val, true);
    $out .= '</pre>';

    return $out;
}

/**
 * Prüft, ob $val einen Leerwert enthält
 */
function checkRequired ($val) {
    if ($val == '' || $val == null) {
        return false;
    }

    return true;
}

/**
 * Prüfen, ob eine valide Ganzzahl übergeben wurde
 *
 * @param mixed $val
 * @return boolean
 */
function checkInt($val) {
    if ( filter_var($val, FILTER_VALIDATE_INT) == false ) {
        return false;
    }

    return true;
}

/**
 * Prüfen, ob valide E-Mail Adresse übergeben wurde
 *
 * @param mixed $val
 * @return boolean
 */
function checkEmail($val) {
    if ( filter_var($val, FILTER_VALIDATE_EMAIL) == false ) {
        return false;
    }

    return true;
}

/**
 * Prüfen, ob eine valide Gleitkommazahl übergeben wurde
 *
 * @param mixed $val
 * @return boolean
 */
function checkFloat($val) {
    if ( filter_var($val, FILTER_VALIDATE_FLOAT) == false ) {
        return false;
    }

    return true;
}

/**
 * Mindestwert einer Zahl prüfen
 *
 * @param mixed $val
 * @param mixed $limit
 * @return bool
 */
function checkMin ($val, $limit) {
    if ($val < $limit) {
        return false;
    }

    return true;
}

/**
 * Undocumented function
 *
 * @param [type] $val
 * @param [type] $limit
 * @return void
 */
function checkMax ($val, $limit) {
    if ($val > $limit) {
        return false;
    }

    return true;
}

/**
 * Undocumented function
 *
 * @param [type] $val
 * @param [type] $min
 * @param [type] $max
 * @return void
 */
function checkBetween($val, $min, $max) {
    if ($val < $min || $val > $max) {
        return false;
    }

    return true;
}

/**
 * Undocumented function
 *
 * @param [type] $val
 * @param [type] $len
 * @return void
 */
function checkExactLen ($val, $len) {
    if (strlen($val) != $len) {
        return false;
    }

    return true;
}

function checkMinLen ($val, $limit) {
   
    if (strlen($val) < $limit) {
        return false;
    }

    return true;
}

function checkMaxLen ($val, $limit) {
    if (strlen($val) > $limit) {
        return false;
    }

    return true;
}

function checkBetweenLen($val, $min, $max) {
    if (strlen($val) < $min || strlen($val) > $max) {
        return false;
    }

    return true;
}

/**
 * Prüft, ob min, max, min_len, max_len gesetzt sind und ob die angegebenen
 * Werte eingehalten wurden.
 *
 * @param string $val
 * @param array $config
 * @return string
 */
function checkMinMax($val, array $config) : string {
    /*
    array $config - der an $config übergebene Wert muss vom Typ array sein
    : string bedeutet, dass der Rückgabewert (return) ein STring sein muss
    */
    // Min/Max Validierung
    $min = $config['min'] ?? '';
    $max = $config['max'] ?? '';
    $min_len = $config['min_len'] ?? '';
    $max_len = $config['max_len'] ?? '';

    // Wenn min & max angegeben sind, muss der Wert dazwischen liegen
    if ($min != '' && $max != '') {
        if (!checkBetween($val, $min, $max)) {
            return $config['label'] . " darf mindestens $min und höchstens $max sein.";
                           
        }
        else {
            return '';
        }
    }
    
    // Zahl - Minimum
    if ($min != '') {
        if (!checkMin($val, $min)) {
            return $config['label'] . " muss mindestens $min sein.";
        }
        else {
            return '';
        }
    }
    
    // Zahl - Maximum
    if ($max != '') {
        if (checkMax($val, $max)) {
            return $config['label'] .  " darf höchstens $max sein.";
        }
        else {
            return '';
        }
    }

    // String: Wenn min_len & max_len angegeben sind, muss der Wert dazwischen liegen
    if ($min_len != '' && $max_len != '') {  
        if(!checkBetweenLen($val, $min_len, $max_len))   {    
            return $config['label'] . " muss mindestens $min_len und darf höchstens $max_len Zeichen enthalten.";   
        }  
        else {
            return '';
        }
    }
    
    
    // String - Mindestlänge
    if ($min_len != '') {
        if (!checkMinLen($val, $min_len)) {
            return $config['label'] . " muss mindestens $min_len Zeichen enthalten.";
        }
        else {
            return '';
        }
    }
    
    // String - Maximale Länge
    if ($max_len != '') {
        if (checkMinLen($val, $max_len)) {
            return $config['label'] .  " darf höchstens $max_len Zeichen enthalten.";
        }
        else {
            return '';
        }
    }

    // alles ist ok!
    return '';
}