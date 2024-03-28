<?php

require_once './models/Contact.php';
require_once './models/ContactManager.php';

class ContactController {
    
    public function add() {
        
        
        $errors = [];
        $valids = [];
        
        if(isset($_POST)) {
            
            if(array_key_exists('lastname', $_POST) && array_key_exists('email', $_POST)
            && array_key_exists('message', $_POST)) {
                
                $formValidator = new FormValidator();
                
                if (!$formValidator->verifyLength($_POST['lastname'], 3, 50)) {
                    $errors[] = "Votre nom doit contenir entre 3 et 50 caractères";
                }
                
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Votre email n'est pas valide";
                }
                
                if (!$formValidator->verifyLength($_POST['email'], 1, 100)) {
                    $errors[] = "Votre email doit contenir moins de 100 caractères";
                }
                
                if (!$formValidator->verifyLength($_POST['message'], 10, 500)) {
                    $errors[] = "Votre message doit contenir entre 10 et 500 caractères";
                }
                
                if(!isset($_POST['token']) || $_POST['token'] != $_SESSION['crsf_token']) {
                    $errors[] = "Une erreur est survenu lors de l'envoi du formulaire";
                }
                
                if(count($errors) === 0) {
                
                    $contact = new Contact();
                    $contact->setLastname($_POST['lastname']);
                    $contact->setEmail($_POST['email']);
                    $contact->setMessage($_POST['message']);
                    
                    $contactManager = new ContactManager();
                    $insert = $contactManager->insert($contact);
                    
                    $token = bin2hex(random_bytes(5));
                    $_SESSION['crsf_token'] = $token;
        
                    if($insert) {
                        $valids[] = "Votre message a bien été envoyé, MERCI !";
                    }
                }
            }
        }
        $token = bin2hex(random_bytes(5));
        $_SESSION['crsf_token'] = $token;
        
        require './views/contact.phtml';
    }

    
}

?>