<?php

class Router {
    
    private array $routes;
    
    public function __construct() {
        $this->routes = require './configs/routes.php';
    }
    
    public function callActionFromRequest(): void {
        
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            if(array_key_exists($_GET['page'], $this->routes)) {
            
                $route = $this->routes[$_GET['page']];
            }else{
                $route = $this->routes['home'];
            }
            
        } else {
            $route = $this->routes['home'];
        }
        
        $controller = new $route['action'][0];
        
        $controller->{$route['action'][1]}();
    }
    
    
    // permet de vérifier si la vue a été rafraichie avec le l'AJAX si oui il n'affiche pas de doublons du header et footer 
    public function isAjax() {
        
        $ajaxActions = [
                
                'itemsBySearch'
            ];
        
        if(isset($_GET['page']) && in_array($_GET['page'], $ajaxActions)){
            return true;
        }else {
            return false;
        }
        
    }
}