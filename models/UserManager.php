<?php 

require_once './models/Manager.php';

class UserManager extends Manager {
    
    public function insert(User $user): string {
        
        
        $parameters = [
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'birthDate' => $user->getBirthDate()->format('Y-m-d H:i:s'),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT)
        ];
        
        $query = $this->db->prepare("
            INSERT INTO users (
                firstname,
                lastname,
                birthdate,
                email,
                password
            ) VALUES (
                :firstName,
                :lastName,
                :birthDate,
                :email,
                :password
            )
        ");
        
        $query->execute($parameters);
        
        return $this->db->lastInsertId();
        
    }
    
    public function selectOneByEmail(User $user): array|bool {
        
        $parameters = [
            'email'     => $user->getEmail(),
        ];
        
        $query = $this->db->prepare("SELECT id_user, email, password, firstname, lastname, birthdate, rank FROM users WHERE email = :email");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
        
    }
    
    public function isExisting(User $user): bool {
        
        $parameters = [
            'email'     => $user->getEmail()
        ];
        
        $query = $this->db->prepare("SELECT id_user FROM users WHERE email = :email");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        if(isset($user['id_user'])) {
            return true;
        } else {
            return false;
        }
    }
    
    public function selectOneById(int $id) {
        
        $parameters = [
            'id_user' => $id    
        ];
        
        $query = $this->db->prepare("
            SELECT id_user, email, firstname, lastname, birthdate 
            FROM users 
            WHERE id_user = :id_user
        ");
        
        $query->execute($parameters);
        
        $user = $query->fetch();
        
        return $user;
        
    }
    
    function update(User $user) {
        
        $parameters = [
            'email'     => $user->getEmail(),
            'firstname' => $user->getFirstName(),
            'lastname'  => $user->getLastName(),
            'birthdate' => $user->getBirthDate()->format('Y-m-d'),
            'id'        => $user->getId()
        ];
        
        $query = $this->db->prepare("
            UPDATE users
            SET 
                email = :email, 
                firstname = :firstname, 
                lastname = :lastname, 
                birthdate = :birthdate
            WHERE id_user = :id
        ");
        
        $query->execute($parameters);
        
    }
    
}



?>