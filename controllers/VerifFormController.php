<?php

require_once './models/User.php';
require_once './models/UserManager.php';

class FormValidator {
    // vérifie la longueur d'une chaîne
    public function verifyLength($data, $minLength, $maxLength) {
        $trimmedData = trim($data);
        $length = strlen($trimmedData);
        return ($length >= $minLength && $length <= $maxLength);
    }

    // vérifie si la chaîne contient uniquement des lettres
    public function verifyOnlyLetters($data) {
        return preg_match('/^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËéèêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/', $data);
    }

    // vérifie si la chaîne contient uniquement des nombres
    public function verifyOnlyNumbers($data) {
        return preg_match('/^[0-9]+$/', $data);
    }
    
    // vérifie si la chaîne contient uniquement des prix avec , et .
    public function verifyOnlyNumbersAndComma($data) {
        return preg_match('/^[0-9,.]+$/', $data);
    }
    

    
    
}
    
    
    
    
?>