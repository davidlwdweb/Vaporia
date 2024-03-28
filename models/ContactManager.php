<?php 

require_once './models/Manager.php';

class ContactManager extends Manager {
    
    public function insert(Contact $contact): string {
        
        
        $parameters = [
            'lastname' => $contact->getLastname(),
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage()
        ];
        
        $query = $this->db->prepare("
            INSERT INTO contacts (
                lastname,
                email,
                message
            ) VALUES (
                :lastname,
                :email,
                :message
            )
        ");
        
        $query->execute($parameters);
        
        return $this->db->lastInsertId();
        
    }
    
    public function selectAllMessage(): array {
        
        $query = $this->db->prepare("
            SELECT id_contact, lastname, email, message, date, status 
            FROM contacts
            ORDER BY status ASC, date ASC
        ");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function selectMessageById($id): array {
        
        $parameters = [
            'id' => $id
        ];
        
        $query = $this->db->prepare("
        SELECT 
        id_contact, lastname, email, message, date, status 
        FROM contacts
        WHERE id_contact = :id
        ");
        $query->execute($parameters);
        return $query->fetch();
    }
    
    public function updateStatusById($id) {
        
        $parameters = [
            'id' => $id
        ];
        
        $query = $this->db->prepare("
        UPDATE contacts
        SET status = 1
        WHERE id_contact = :id;
        ");
        $query->execute($parameters);
    }
    
    public function deleteMessage($id){ 
        
        $parameters = [
            'id' => $id
        ];
        
        $query = $this->db->prepare("
        DELETE FROM contacts 
        WHERE id_contact = :id
        ");
        $query->execute($parameters);
        return $query->fetch();
    }
    
}