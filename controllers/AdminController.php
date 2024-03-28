<?php

require_once './models/User.php';
require_once './models/Item.php';
require_once './models/AdminManager.php';

class AdminController {
    
    public function admin() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        
        require './views/admin.phtml';
        
    }
    
    public function items() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        $adminManager = new AdminManager();
        $items = $adminManager->selectAll();
        
        require './views/admin_items.phtml';
        
    }
    
    public function add() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        $adminManager = new AdminManager();
        
        $formValidator = new FormValidator();
        
        $categories = $adminManager->selectCategorie();
        
        $makers = $adminManager->selectMaker();
        
        $errors = [];
        $valids = [];
        
        $addItem = [
                    'available'     => "",
                    'categorie'     => "",
                    'maker'         => "",
                    'title'         => "",
                    'description'   => "",
                    'price'         => "",
                    'quantity'      => "",
                    'power'         => NULL,
                    'capacity'      => NULL,
                    'origin'        => "",
                    'battery'       => NULL,
                    'picture'       => "",
                    'caption'       => ""
        ];
        
        if(isset($_POST)) {
            
            if(array_key_exists('available', $_POST) && array_key_exists('categorie', $_POST) 
                && array_key_exists('maker', $_POST) && array_key_exists('title', $_POST) 
                && array_key_exists('description', $_POST) && array_key_exists('price', $_POST) 
                && array_key_exists('quantity', $_POST) && array_key_exists('origin', $_POST) 
                && array_key_exists('picture', $_FILES) && array_key_exists('caption', $_POST)) {
                    
                // var_dump($_POST);
                $addItem = [
                    'available'     => $_POST['available'],
                    'categorie'     => $_POST['categorie'],
                    'maker'         => $_POST['maker'],
                    'title'         => $_POST['title'],
                    'description'   => $_POST['description'],
                    'price'         => $_POST['price'],
                    'quantity'      => $_POST['quantity'],
                    'power'         => NULL,
                    'capacity'      => NULL,
                    'origin'        => $_POST['origin'],
                    'battery'       => NULL,
                    'picture'       => $_FILES['picture'],
                    'caption'       => $_POST['caption']
                ];
                if(array_key_exists('power', $_POST)){
                    $addItem['power'] = $_POST['power'];
                }
                if(array_key_exists('capacity', $_POST)){
                    $addItem['capacity'] = $_POST['capacity'];
                }
                if(array_key_exists('battery', $_POST)){
                    $addItem['battery'] = $_POST['battery'];
                }
                
                
                if($addItem['power'] != null) {
                    
                        // vérification pour power
                    if (!$formValidator->verifyLength($addItem['power'], 1, 5)) {
                        $errors[] = "Le champ de la puissance doit contenir entre 1 et 5 caractères";
                    }
                    
                    if (!$formValidator->verifyOnlyNumbersAndComma($addItem['power'])) {
                        $errors[] = "Le champ de la puissance doit contenir que des nombres";
                    }
                }
                
                if($addItem['capacity'] != null) {
                    
                    // vérification pour la capacity
                    if (!$formValidator->verifyLength($addItem['capacity'], 1, 5)) {
                        $errors[] = "Le champ de la capacité doit contenir entre 1 et 5 caractères";
                    }
                }
                    
                if($addItem['battery'] != null) {
                    
                    // vérification pour battery
                    if (!$formValidator->verifyLength($addItem['battery'], 1, 50)) {
                        $errors[] = "Le champ battery doit contenir entre 1 et 50 caractères";
                    }
                }
                
                
                // vérification pour available
                if(!$formValidator->verifyLength($addItem['available'], 1, 1)) {
                    $errors[] = "Le champ de la visibiliter du produit ne doit contenir qu'un chiffre";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['available'])) {
                    $errors[] = "Le champ de la visibiliter du produit ne doit contenir que les propositions suggérer";
                }
                
                
                // vérification pour categorie
                if(!$formValidator->verifyLength($addItem['categorie'], 1, 1)) {
                    $errors[] = "Le champ de la categorie doit contenir qu'une catégorie parmi les propositions";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['categorie'])) {
                    $errors[] = "Le champ de la catégorie doit contenir qu'une catégorie parmi les propositions";
                }
                
                
                // vérification pour maker
                if(!$formValidator->verifyLength($addItem['maker'], 1, 2)) {
                    $errors[] = "Le champ de la marque du produit ne doit contenir que les propositions suggérer";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['maker'])) {
                    $errors[] = "Le champ de la marque du produit ne doit contenir qu'une marque parmi les propositions";
                }
                
                
                // vérification pour title
                if(!$formValidator->verifyLength($addItem['title'], 3, 50)) {
                    $errors[] = "Le champ du titre doit contenir entre 3 et 50 caractères";
                }
                
                
                // vérification pour description
                if(!$formValidator->verifyLength($addItem['description'], 30, 1000)) {
                    $errors[] = "Le champ de la description doit contenir entre 30 et 1000 caractères";
                }
                
                
                // vérification pour price
                if(!$formValidator->verifyOnlyNumbersAndComma($addItem['price'])) {
                    $errors[] = "Le champ du prix ne doit pas contenir de chiffre";
                } else {
                    if($addItem['price'] < 1 || $addItem['price'] > 1000) {
                         $errors[] = "Le prix doit être compris entre 1€ et 1000€";
                    }
                }
                
                
                // vérification pour quantity
                if(!$formValidator->verifyLength($addItem['quantity'], 1, 5)) {
                    $errors[] = "Le champ de la quantiter doit contenir entre 1 et 5 caractères";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['quantity'])) {
                    $errors[] = "Le champ quantité doit contenir que des nombres et sans virgule";
                }
                
                
                // vérification pour origin
                if(!$formValidator->verifyLength($addItem['origin'], 1, 30)) {
                    $errors[] = "Le champ origine doit contenir entre 1 et 30 caractères";
                }
                
                if(!$formValidator->verifyOnlyletters($addItem['origin'])) {
                    $errors[] = "Le champ origine doit contenir que des lettres";
                }
                
                if($_FILES['picture']['error'] == 0){
                    
                    if($_FILES['picture']['size'] > 2000000){
                        $errors[] = "Le fichier est trop volumineux !";
                    }
                    
                    // vérifier l'extension
                    $extFichier = explode('.', $_FILES['picture']['name']);
                    $fileExtension = strtolower(end($extFichier)); // jpg
                    
                    // Extensions acceptées
                    $extensionPerm = ['jpeg', 'jpg', 'png', 'gif']; // array
                    if(!in_array($fileExtension, $extensionPerm)){
                        $errors[] = "L'extension n'est pas acceptée !";
                    }
                    
                    // vérifier le contenu du fichier --> document.txt --> change l'extension --> document.png
                    $mime_type = array(
                        'png' => 'image/png',
                        'jpeg' => 'image/jpeg',
                        'jpg' => 'image/jpeg',
                        'gif' => 'image/gif',
                    );
                    
                    $contenu = $mime_type[$fileExtension]; // var_dump($contenu); 'image/jpeg'
                    $contenuByPhp = mime_content_type($_FILES['picture']['tmp_name']);
                    
                    if($contenu != $contenuByPhp){
                        $errors[] = "Une erreur est survenue lors de l'upload du fichier !";
                    }
                }
                
                // vérification pour caption
                if (!$formValidator->verifyLength($addItem['caption'], 10, 200)) {
                    $errors[] = "Le champ description de la photo principal doit contenir entre 10 et 200 caractères";
                }
                
                // var_dump($_POST);
                // var_dump($addItem);
                
                if(count($errors) == 0 && !empty($fileExtension)) {
                    
                    $destinationFolder = 'public/img/uploads/items/';
                    // Renomer le fichier avant enregistrement
                    $newName = uniqid() . '.' . $fileExtension; 
                    
                    $pathNewFile = $destinationFolder . $newName;
                    
                    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $pathNewFile)) {
                        
                        $errors[] = "Une erreur est survenue lors de l'upload du fichier.";
                    }else{
                        
                        $item = new Item();
                        
                        $item->setAvailable($addItem['available']);
                        $item->setCategorieId($addItem['categorie']);
                        $item->setTitle($addItem['title']);
                        $item->setMakerId($addItem['maker']);
                        $item->setDescription($addItem['description']);
                        $item->setPrice($addItem['price']);
                        $item->setQuantity($addItem['quantity']);
                        $item->setPower($addItem['power']);
                        $item->setCapacity($addItem['capacity']);
                        $item->setOrigin($addItem['origin']);
                        $item->setBattery($addItem['battery']);
                        $item->setPicture($newName);
                        $item->setCaption($addItem['caption']);
                        
                        $adminManager->insert($item);
                        
                        $valids[] = "L'article a bien été ajouter";
                    }
                    
                }else{
                    $errors[] = "Merci de vérifier l'intégraliter des champs et le chargement de l'image";
                }
                
                
            }else{
                if(!isset($_POST) || empty($_POST)){
                    
                }else {
                    
                    $errors[] = 'Veuillez remplir le formulaire correctement';
                }
            }
            
            require './views/admin_item_add.phtml';
            
        }
    }
    
    public function update() {
        
        $verifRank = new VerifRank();
        $verifRank->verifAdminRank();
        
        $formValidator = new FormValidator();
        
        $adminManager = new AdminManager();
        
        $categories = $adminManager->selectCategorie();
        
        $makers = $adminManager->selectMaker();
        
        $item = $adminManager->selectById($_GET['id']);
        
        $errors = [];
        
        $addItem = [
                    'available'     => "",
                    'categorie'     => "",
                    'maker'         => "",
                    'title'         => "",
                    'description'   => "",
                    'price'         => "",
                    'quantity'      => "",
                    'power'         => NULL,
                    'capacity'      => NULL,
                    'origin'        => "",
                    'battery'       => NULL,
                    'picture'       => $item['picture'],
                    'caption'       => ""
        ];
        
        $oldNamePicture = $item['picture'];
        
        if(isset($_POST)) {
            
            
            if(array_key_exists('available', $_POST) && array_key_exists('categorie', $_POST) 
                && array_key_exists('maker', $_POST) && array_key_exists('title', $_POST) 
                && array_key_exists('description', $_POST) && array_key_exists('price', $_POST) 
                && array_key_exists('quantity', $_POST) && array_key_exists('origin', $_POST) 
                && array_key_exists('caption', $_POST)) {
                    
                $addItem['available'] = $_POST['available'];
                $addItem['categorie'] = $_POST['categorie'];
                $addItem['maker'] = $_POST['maker'];
                $addItem['title'] = $_POST['title'];
                $addItem['description'] = $_POST['description'];
                $addItem['price'] = $_POST['price'];
                $addItem['quantity'] = $_POST['quantity'];
                $addItem['origin'] = $_POST['origin'];
                $addItem['caption'] = $_POST['caption'];
                
                if(array_key_exists('power', $_POST)){
                    $addItem['power'] = $_POST['power'];
                }
                if(array_key_exists('capacity', $_POST)){
                    $addItem['capacity'] = $_POST['capacity'];
                }
                if(array_key_exists('battery', $_POST)){
                    $addItem['battery'] = $_POST['battery'];
                }
                
                
                
                if($addItem['power'] != null) {
                    
                        // vérification pour power
                    if (!$formValidator->verifyLength($addItem['power'], 1, 5)) {
                        $errors[] = "Le champ de la puissance doit contenir entre 1 et 5 caractères";
                    }
                    
                    if (!$formValidator->verifyOnlyNumbersAndComma($addItem['power'])) {
                        $errors[] = "Le champ de la puissance doit contenir que des nombres";
                    }
                }
                
                if($addItem['capacity'] != null) {
                    
                    // vérification pour la capacity
                    if (!$formValidator->verifyLength($addItem['capacity'], 1, 5)) {
                        $errors[] = "Le champ de la capacité doit contenir entre 1 et 5 caractères";
                    }
                }
                    
                if($addItem['battery'] != null) {
                    
                    // vérification pour battery
                    if (!$formValidator->verifyLength($addItem['battery'], 1, 50)) {
                        $errors[] = "Le champ battery doit contenir entre 1 et 50 caractères";
                    }
                }
                
                
                // vérification pour available
                if(!$formValidator->verifyLength($addItem['available'], 1, 1)) {
                    $errors[] = "Le champ de la visibiliter du produit ne doit contenir qu'un chiffre";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['available'])) {
                    $errors[] = "Le champ de la visibiliter du produit ne doit contenir que les propositions suggérer";
                }
                
                
                // vérification pour categorie
                if(!$formValidator->verifyLength($addItem['categorie'], 1, 1)) {
                    $errors[] = "Le champ de la categorie doit contenir qu'une catégorie parmi les propositions";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['categorie'])) {
                    $errors[] = "Le champ de la catégorie doit contenir qu'une catégorie parmi les propositions";
                }
                
                
                // vérification pour maker
                if(!$formValidator->verifyLength($addItem['maker'], 1, 2)) {
                    $errors[] = "Le champ de la marque du produit ne doit contenir que les propositions suggérer";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['maker'])) {
                    $errors[] = "Le champ de la marque du produit ne doit contenir qu'une marque parmi les propositions";
                }
                
                
                // vérification pour title
                if(!$formValidator->verifyLength($addItem['title'], 3, 50)) {
                    $errors[] = "Le champ du titre doit contenir entre 3 et 50 caractères";
                }
                
                
                // vérification pour description
                if(!$formValidator->verifyLength($addItem['description'], 30, 1000)) {
                    $errors[] = "Le champ de la description doit contenir entre 30 et 1000 caractères";
                }
                
                
                // vérification pour price
                if(!$formValidator->verifyOnlyNumbersAndComma($addItem['price'])) {
                    $errors[] = "Le champ du prix ne doit pas contenir de chiffre";
                } else {
                    if($addItem['price'] < 1 || $addItem['price'] > 1000) {
                         $errors[] = "Le prix doit être compris entre 1€ et 1000€";
                    }
                }
                
                
                // vérification pour quantity
                if(!$formValidator->verifyLength($addItem['quantity'], 1, 5)) {
                    $errors[] = "Le champ de la quantiter doit contenir entre 1 et 5 caractères";
                }
                
                if(!$formValidator->verifyOnlyNumbers($addItem['quantity'])) {
                    $errors[] = "Le champ quantité doit contenir que des nombres et sans virgule";
                }
                
                
                // vérification pour origin
                if(!$formValidator->verifyLength($addItem['origin'], 1, 30)) {
                    $errors[] = "Le champ origine doit contenir entre 1 et 30 caractères";
                }
                
                if(!$formValidator->verifyOnlyletters($addItem['origin'])) {
                    $errors[] = "Le champ origine doit contenir que des lettres";
                }
                
                if($_FILES['picture']['error'] == 0){
                    
                    if($_FILES['picture']['size'] > 2000000){
                        $errors[] = "Le fichier est trop volumineux !";
                    }
                    
                    // vérifier l'extension
                    $extFichier = explode('.', $_FILES['picture']['name']);
                    $fileExtension = strtolower(end($extFichier)); // jpg
                    
                    // Extensions acceptées
                    $extensionPerm = ['jpeg', 'jpg', 'png', 'gif']; // array
                    if(!in_array($fileExtension, $extensionPerm)){
                        $errors[] = "L'extension n'est pas acceptée !";
                    }
                    
                    // vérifier le contenu du fichier --> document.txt --> change l'extension --> document.png
                    $mime_type = array(
                        'png' => 'image/png',
                        'jpeg' => 'image/jpeg',
                        'jpg' => 'image/jpeg',
                        'gif' => 'image/gif',
                    );
                    
                    $contenu = $mime_type[$fileExtension]; // var_dump($contenu); 'image/jpeg'
                    $contenuByPhp = mime_content_type($_FILES['picture']['tmp_name']);
                    
                    if($contenu != $contenuByPhp){
                        $errors[] = "Une erreur est survenue lors de l'upload du fichier !";
                    }
                }
                
                // vérification pour caption
                if (!$formValidator->verifyLength($addItem['caption'], 10, 200)) {
                    $errors[] = "Le champ description de la photo principal doit contenir entre 10 et 200 caractères";
                }
                
                if(count($errors) == 0 && !empty($fileExtension)) {
                    
                    $destinationFolder = 'public/img/uploads/items/';
                    // Renomer le fichier avant enregistrement
                    $newName = uniqid() . '.' . $fileExtension; 
                    
                    $pathNewFile = $destinationFolder . $newName;
                    
                    if($_FILES['picture']['name'] != ''){
                        $addItem['picture'] = $newName;
                    }
                    
                    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $pathNewFile)) {
                        
                        $errors[] = "Une erreur est survenue lors de l'upload du fichier.";
                    }else {
                        unlink($destinationFolder . $oldNamePicture);
                    }
                }
                
                // var_dump($addItem['picture']);
                // die;
                
                if(count($errors) == 0 && !empty($item['picture'])){
                    
                    $item = new Item();
                    
                    $item->setId($_GET['id']);
                    $item->setTitle($addItem['title']);
                    $item->setDescription($addItem['description']);
                    $item->setPrice($addItem['price']);
                    $item->setQuantity($addItem['quantity']);
                    $item->setPower($addItem['power']);
                    $item->setCapacity($addItem['capacity']);
                    $item->setMakerId($addItem['maker']);
                    $item->setOrigin($addItem['origin']);
                    $item->setBattery($addItem['battery']);
                    $item->setAvailable($addItem['available']);
                    $item->setCategorieId($addItem['categorie']);
                    $item->setPicture($addItem['picture']);
                    $item->setCaption($addItem['caption']);
                    
                    $adminManager->update($item);
                    
                    header('Location: index.php?page=admin_items');
                    exit;
                    
                }
                
            }else{
                if(!isset($_POST) || empty($_POST)){
                    
                }else {
                    
                    $errors[] = 'Veuillez remplir le formulaire correctement';
                }
            }
        
        require './views/admin_item_update.phtml';
        
        }
    }
}

?>