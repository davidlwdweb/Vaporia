<?php

require_once './models/User.php';


class VerifRank {
    
    public function verifAdminRank() {
        
        if(!isset($_SESSION['rank']) || ($_SESSION['rank']) != 1) {
            header('Location: index.php?page=home');
            exit;
        }
    }
    
    public function verifUserRank() {
        if(!isset($_SESSION['rank']) || ($_SESSION['rank']) != 0) {
            header('Location: index.php?page=login');
            exit;
        }
    }
    
}


?>