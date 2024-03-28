<?php 

require_once './models/Manager.php';

class CategorieManager extends Manager {
    
    public function selectAllCategories() {
        
        
        $query = $this->db->prepare("
        SELECT id_categorie, title
        FROM categories
        ");
        
        $query->execute();
        
        return $query->fetchAll();
        
    }
    
}



?>