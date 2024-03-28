<?php

require_once './models/Contact.php';
require_once './models/AdminManager.php';

class MessageController {
    
    public function message() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        $contactManager = new ContactManager();
        $messages = $contactManager->selectAllMessage();
        
        require './views/recipse_message.phtml';
        
    }
    
    public function messageById() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        $contactManager = new ContactManager();
        $message = $contactManager->selectMessageById($_GET['id']);
        $result = $contactManager->updateStatusById($_GET['id']);
        
        
        require './views/message.phtml';
        
    }
    
    public function deleteMessageById() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        $errors = [];
        
        if (isset($_POST["delete"]) && !empty($_POST["delete"]) && isset($_POST['delete'])) {
                
            $contactManager = new ContactManager(); 
            $contactManager->deleteMessage($_POST['id']); 

            header('Location: index.php?page=recipse_message');
            exit();
        } else {
            $errors[] = "Une erreur est survenue lors de la suppression.";
        }
    }
    
}

?>