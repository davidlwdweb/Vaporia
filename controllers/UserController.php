<?php

require_once './models/User.php';
require_once './models/UserManager.php';

class UserController {
    
    public function add() {
        
        $errors = [];
        
        if(isset($_POST)) {
            
            if(array_key_exists('firstname', $_POST) && array_key_exists('lastname', $_POST)
            && array_key_exists('password', $_POST) && array_key_exists('email', $_POST)
            && array_key_exists('birthdate', $_POST)) {
                
                $formValidator = new FormValidator();
                
                if (!$formValidator->verifyLength($_POST['firstname'], 3, 50)) {
                    $errors[] = "Votre prénom doit contenir entre 3 et 50 caractères";
                }
                
                if (!$formValidator->verifyOnlyLetters($_POST['firstname'])) {
                    $errors[] = "Votre prénom ne doit pas contenir de chiffre";
                }
                
                if (!$formValidator->verifyLength($_POST['lastname'], 3, 50)) {
                    $errors[] = "Votre nom doit contenir entre 3 et 50 caractères";
                }
                
                if (!$formValidator->verifyOnlyLetters($_POST['lastname'])) {
                    $errors[] = "Votre nom ne doit pas contenir de chiffre";
                }
                
                if (!$formValidator->verifyLength($_POST['password'], 8, 30)) {
                    $errors[] = "Le mot de passe doit contenir plus de 8 caractères et maximum 30";
                }
                
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Votre email n'est pas valide";
                }
                
                if (!$formValidator->verifyLength($_POST['email'], 1, 100)) {
                    $errors[] = "Votre email doit contenir moins de 100 caractères";
                }
                    
                if(!$_POST['birthdate'])
                    $errors [] = "La date de naissance ne doit pas être vide";
                
                if(!empty($_POST['birthdate'])) {
                    $birthdate = $_POST['birthdate'];
                    
                    // Vérifie si la date de naissance est au format valide (YYYY-MM-DD)
                    $date_format = 'Y-m-d';
                    $birthdate_date = DateTime::createFromFormat($date_format, $birthdate);
                    
                    if(!$birthdate_date || $birthdate_date->format($date_format) !== $birthdate) {
                        $errors[] = "Le format de la date de naissance n'est pas valide (YYYY-MM-DD).";
                    }else {
                        // Vérifie si la date de naissance existe
                        $birthdate_parts = explode('-', $birthdate);
                        $year = (int)$birthdate_parts[0];
                        $month = (int)$birthdate_parts[1];
                        $day = (int)$birthdate_parts[2];
                        
                        if(!checkdate($month, $day, $year)) {
                            $errors[] = "La date de naissance n'existe pas.";
                        }else {
                            $date = new DateTime();
                            $date_18 = $date->sub(new DateInterval('P18Y'));
                            $birthdate_18 = new DateTime($birthdate);
                            // Vérifie si l'utilisateur est majeur
                            if ($birthdate_18 >= $date_18) {
                                $errors[] = "Vous avez moins de 18 ans";
                            }
                            if ($year < 1943) {
                                $errors[] = "L'année de naissance n'est pas valide. Nous avons bloquer les utilisateurs né avant 1943.";
                            }
                        }
                    }
                }
                
                if(count($errors) === 0) {
            
                    $user = new User();
                    $user->setFirstname($_POST['firstname']);
                    $user->setLastname($_POST['lastname']);
                    $user->setBirthDate(new DateTime($_POST['birthdate']));
                    $user->setEmail($_POST['email']);
                    $user->setPassword($_POST['password']);
                    
                    $userManager = new UserManager();
                    if($userManager->isExisting($user)) {
                        $errors[] = "Cet email est déjà utilisé";
                    } else {
                        $_SESSION['id_user'] = $userManager->insert($user);
                        $_SESSION['email'] = $user->getEmail();
                        $_SESSION['firstname'] = $user->getFirstname();
                        $_SESSION['lastname'] = $user->getLastname();
                        $_SESSION['birthdate'] = $user->getBirthdate();
                    
                        header('Location: index.php?page=home&register=ok');
                        exit;
                    }
                }
                
            }
            require './views/add_user.phtml';
        }
    }
    
    public function connect() {
        
        
        if($_GET['page'] === 'logout') {
    
            session_destroy();
            
            header('Location: index.php?page=home');
            exit;
        }
        
        if(!empty($_POST)) {
            
            $errors = [];
            
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            
            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($user);
            
            if(!$user) {
                
                $errors [] = 'Échec de l\'authentification';
                
            }elseif(password_verify($_POST['password'], $user['password'] )) {
                
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['birthdate'] = $user['birthdate'];
                $_SESSION['rank'] = $user['rank'];
                
                header('Location: index.php');
                exit;
                
            }else {
                
                $errors [] = 'Échec de l\'authentification';
            }
            
        }
        
        require './views/login.phtml';
    }
    
    public function update() {
        
        $userManager = new UserManager();
        
        $user = $userManager->selectOneById($_SESSION['id_user']);
        
        $oldEmail = $user['email'];
        
        if(!empty($_POST)) {
            
            $errors = [];
            
            if(array_key_exists('firstname', $_POST) && array_key_exists('lastname', $_POST) 
            && array_key_exists('email', $_POST) && array_key_exists('birthdate', $_POST)) {
                
                $formValidator = new FormValidator();
                
                if (!$formValidator->verifyLength($_POST['firstname'], 3, 50)) {
                    $errors[] = "Votre prénom doit contenir entre 3 et 50 caractères";
                }
                    
                if (!$formValidator->verifyOnlyLetters($_POST['firstname'])) {
                    $errors[] = "Votre prénom ne doit pas contenir de chiffre";
                }
                
                if (!$formValidator->verifyLength($_POST['lastname'], 3, 50)) {
                    $errors[] = "Votre nom doit contenir entre 3 et 50 caractères";
                }
                
                if (!$formValidator->verifyOnlyLetters($_POST['lastname'])) {
                    $errors[] = "Votre nom ne doit pas contenir de chiffre";
                }
                
                if(empty($_POST['email']) || !FILTER_VAR($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Votre email n'est pas valide";
                }
                
                if (!$formValidator->verifyLength($_POST['email'], 1, 100)) {
                    $errors[] = "Votre email doit contenir moins de 100 caractères";
                }
                    
                if(!$_POST['birthdate'])
                    $errors [] = "La date de naissance ne doit pas être vide";
                    
                if (!empty($_POST['birthdate'])) {
                    $birthdate = $_POST['birthdate'];
                    
                    // Vérifie si la date de naissance est au format valide (YYYY-MM-DD)
                    $date_format = 'Y-m-d';
                    $birthdate_date = DateTime::createFromFormat($date_format, $birthdate);
                    
                    if (!$birthdate_date || $birthdate_date->format($date_format) !== $birthdate) {
                        $errors[] = "Le format de la date de naissance n'est pas valide (YYYY-MM-DD).";
                    } else {
                        // Vérifie si la date de naissance existe
                        $birthdate_parts = explode('-', $birthdate);
                        $year = (int)$birthdate_parts[0];
                        $month = (int)$birthdate_parts[1];
                        $day = (int)$birthdate_parts[2];
                        
                        if (!checkdate($month, $day, $year)) {
                            $errors[] = "La date de naissance n'existe pas.";
                        } else {
                            $date = new DateTime();
                            $date_18 = $date->sub(new DateInterval('P18Y'));
                            $birthdate_18 = new DateTime($birthdate);
                            // Vérifie si l'utilisateur est majeur
                            if ($birthdate_18 >= $date_18) {
                                $errors[] = "Vous avez moins de 18 ans";
                            }
                            if ($year < 1943) {
                                $errors[] = "L'année de naissance n'est pas valide. Nous avons bloquer les utilisateurs né avant 1943.";
                            }
                        }
                    }
                }
            }
            
            if(count($errors) === 0) {
            
                $user = new User();
                $user->setId($_SESSION['id_user']);
                $user->setEmail($_POST['email']);
                $user->setFirstName($_POST['firstname']);
                $user->setLastName($_POST['lastname']);
                $user->setBirthDate(new DateTime($_POST['birthdate']));
                
                if($userManager->isExisting($user) && $user->getEmail() !== $oldEmail) {
                        
                    $userAlreadyExist = "L'Email existe déjà";
                        
                } else {
                    $userManager->update($user);
                    
                    $_SESSION['email'] = $user->getEmail();
                }
            }
            $user = $userManager->selectOneById($_SESSION['id_user']);
            
        }
        
        require './views/profil.phtml';

    }
    
}


?>