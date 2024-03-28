<?php

require_once './models/ItemManager.php';
require_once './models/CategorieManager.php';

class ItemController {
    
    public function items() {
        
        $itemManager = new ItemManager();
        $items = $itemManager->selectItemsByCatId($_GET['idCat']);
        $makers = $itemManager->selectAllMakers();
        
        require_once './views/items.phtml';
    }
    
    public function item() {
        
            
        $itemManager = new ItemManager();
        $itemId = $itemManager->selectItem($_GET['id']);
        
        require_once './views/item.phtml';
    }
    
    
    
    public function itemsBySearch() :void {
        
        $content = file_get_contents("php://input");
        $data = json_decode($content, true);
        
        $search = "%".$data['textToFind']."%";
        
        $itemSearch = new ItemManager();
        $items = $itemSearch->selectItemsByAjax($search);
        
        $countItems = count($items);
        
        include 'views/itemsBySearch.phtml';
        
    }
    
}

?>