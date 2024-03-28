<?php
class Database {
    
    private array $config;
    
    private PDO $database;
    
    public function __construct() {
        
        $this->config = require 'configs/db_config.php';
        
        $this->initConnexion();
        
    }
    
    private function initConnexion(): void {
        
        $this->database = new PDO(
            'mysql:host='.$this->config['host'].';port='.$this->config['port'].';dbname='.$this->config['dbname'].';charset=UTF8',
            $this->config['username'],
            $this->config['password'], [
                // Option qui permet de ne récupérer que le nom des colonnes
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC    
            ]
        );
        
    }
    
    public function getConnexion(): PDO {
        return $this->database;
    }
    
}

?>