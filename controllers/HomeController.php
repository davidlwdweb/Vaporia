<?php

require_once './models/ItemManager.php';
require_once './models/CategorieManager.php';

class HomeController {
    
    public function home(): void {
        
        $itemManager = new ItemManager();
        $items = $itemManager->selectAllItems();
        $packs = $itemManager->selectPacksItems();
        
        $categorieManager = new CategorieManager();
        $_SESSION['categories'] = $categorieManager->selectAllCategories();
        // var_dump($_SESSION['categories']);
        
        $title = 'Accueil';
        require_once './views/home.phtml';
    }
    
}

?>