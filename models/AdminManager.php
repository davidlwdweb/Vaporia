<?php

require_once './models/Manager.php';

class AdminManager extends Manager {
    
    public function selectAll(): array {
        
        $query = $this->db->prepare("
        SELECT 
        id_item, items.title, items.description, price, quantity, power, capacity, makers.maker, origin, battery, available, categories.title 
        AS categorie_title, picture, caption
        FROM items
        INNER JOIN categories
        ON id_categorie = categorie_id
        INNER JOIN makers
        ON id_maker = maker_id
        ");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function selectMaker(): array {
        
        $query = $this->db->prepare("
        SELECT id_maker, maker
        FROM makers
        ORDER BY maker
        ");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function selectCategorie(): array {
        
        $query = $this->db->prepare("
        SELECT id_categorie, title, description
        FROM categories
        ORDER BY title
        ");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function insert(Item $item): string {
        
        $parameters = [
            'available' => $item->getAvailable(),
            'categorie' => $item->getCategorieId(),
            'title' => $item->getTitle(),
            'maker' => $item->getMakerId(),
            'description' => $item->getDescription(),
            'price' => $item->getPrice(),
            'quantity' => $item->getQuantity(),
            'power' => $item->getPower(),
            'capacity' => $item->getCapacity(),
            'origin' => $item->getOrigin(),
            'battery' => $item->getBattery(),
            'picture' => $item->getPicture(),
            'caption' => $item->getCaption()
        ];
        
        $query = $this->db->prepare("
            INSERT INTO items (
                available,
                categorie_id,
                title,
                maker_id,
                description,
                price,
                quantity,
                power,
                capacity,
                origin,
                battery,
                picture,
                caption
            ) VALUES (
                :available,
                :categorie,
                :title,
                :maker,
                :description,
                :price,
                :quantity,
                :power,
                :capacity,
                :origin,
                :battery,
                :picture,
                :caption
            )
        ");
        
        $query->execute($parameters);
        
        return $this->db->lastInsertId();
        
    }
    
    public function update(Item $item) {
        

        $parameters = [
            
            'id' => $item->getId(),
            'title' => $item->getTitle(),
            'description' => $item->getDescription(),
            'price' => $item->getPrice(),
            'quantity' => $item->getQuantity(),
            'power' => $item->getPower(),
            'capacity' => $item->getCapacity(),
            'maker' => $item->getMakerId(),
            'origin' => $item->getOrigin(),
            'battery' => $item->getBattery(),
            'available' => $item->getAvailable(),
            'categorie' => $item->getCategorieId(),
            'picture' => $item->getPicture(),
            'caption' => $item->getCaption(),
            'date_modification' => date_create('now')->format('Y-m-d H:i:s')
        ];
        
        
        $query = $this->db->prepare("
            UPDATE items 
            SET
                title = :title,
                description = :description,
                price = :price,
                quantity = :quantity,
                power = :power,
                capacity = :capacity,
                maker_id = :maker,
                origin = :origin,
                battery = :battery,
                available = :available,
                categorie_id = :categorie,
                picture = :picture,
                caption = :caption,
                date_modification = :date_modification
            WHERE id_item = :id
        ");
        
        $query->execute($parameters);
        
    }
    
    public function selectById($id): array {
        
        $parameters = [
            'id' => $id
        ];
        
        $query = $this->db->prepare("
        SELECT 
        id_item, title, description, price, quantity, power, capacity, origin, battery, available, date_modification,
        picture, caption, maker_id, categorie_id
        FROM items
        WHERE id_item = :id
        ");
        $query->execute($parameters);
        return $query->fetch();
    }
    
    
    
}

?>