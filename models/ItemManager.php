<?php 
require_once './models/Manager.php';

class ItemManager extends Manager {
    
    
    /**
     * Methode permettant de sélectionner dans la bdd tous les items avec une limite de 6 par ordre décroissant d'id
     * 
     * @param void
     * 
     * return array - Un jeu d'enregistrement
    */
    public function selectAllItems(): array {
        
        $query = $this->db->prepare('
            SELECT id_item, title, description, price, picture, caption
            FROM items 
            WHERE available = 1
            ORDER BY id_item 
            DESC LIMIT 6
        ');
        $query->execute();
        return $query->fetchAll();
    }
    
    public function selectPacksItems(): array {
        
        $query = $this->db->prepare('
            SELECT id_item, title, description, price, picture, caption
            FROM items 
            WHERE categorie_id = 4 
            AND available = 1
            ORDER BY id_item 
            DESC LIMIT 6
        ');
        $query->execute();
        return $query->fetchAll();
    }
    
    public function selectItemsByCatId(int $categorieId) {
        
        $parameters = [
            'categorie_id' => $categorieId
        ];
        
        $query = $this->db->prepare('
            SELECT id_item, title, description, price, categorie_id, picture, caption
            FROM items 
            WHERE categorie_id = :categorie_id
            AND available = 1
            ORDER BY id_item 
            DESC LIMIT 24
        ');
        $query->execute($parameters);
        $items_categories = $query->fetchAll();
        
        return $items_categories;
    }
    
    public function selectAllMakers() {
        
        $query = $this->db->prepare('
            SELECT id_maker, maker 
            FROM makers 
            ORDER BY maker
            LIMIT 50
        ');
        $query->execute();
        return $query->fetchAll();
        
    }
    
    
    /**
     * Methode permettant de sélectionner dans la bdd un SEUL item en fonction de son id
     * 
     * @param int $itemId -  L'id de l'item à rechercher
     * 
     * return array - Un enregistrement correspondant à l'id de l'item
    */
    public function selectItem(int $itemId): array {
        
        $parameters = [
            'id'        => $itemId
        ];
        
        $query = $this->db->prepare('
            SELECT
                items.id_item, items.title, items.description, items.price, items.power, items.capacity, items.origin, items.battery, items.picture, items.caption,
                makers.maker, 
                categories.title AS categorie_title
            FROM items
            INNER JOIN categories
                ON id_categorie = categorie_id
            INNER JOIN makers
                ON id_maker = maker_id
            WHERE id_item = :id
        ');
        
        $query->execute($parameters);
        $item = $query->fetch();
        
        return $item;
    }
    
    public function selectItemsByAjax($search) {
        $parameters = [
            'title' => $search
        ];
        
        $query = $this->db->prepare('
            SELECT id_item, title, description, price, picture, categorie_id
            FROM items 
            WHERE title like :title
            AND available = 1
        ');
        
        $query->execute($parameters);
        return $query->fetchAll();
    }
    
}

?>