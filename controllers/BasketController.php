<?php

class BasketController {
    
    /**
     * Methode permettant d'ajouter un article dans le panier
     * 
     * @param void
     * 
     * return void
    */
    function addToCart() {
        
        $product = $_GET['id'];
        $name = 'addToCart';
        
        if(empty($_COOKIE[$name])) {
            
            $cookie = [['productId' => $product, 'qty' => 1]];
            $cookie = json_encode($cookie);
            setcookie($name, $cookie, time() + 86400);
            
        } else {
            
            $cookie = json_decode($_COOKIE[$name], true);
            
            if(array_search($product, array_column($cookie, 'productId')) === false){
                
                array_push($cookie, ['productId' => $product, 'qty' => 1]);
                
            } else {
                
                $index = array_search($product, array_column($cookie, 'productId'));
                $cookie[$index]['qty'] = $cookie[$index]['qty'] + 1;
                
            }

            $cookie = json_encode($cookie);
            setcookie($name, $cookie, time() + 86400);
        }
        
        header("Location: index.php?page=cart");
        exit();
    }
    
    function readToCart() {
        $name = 'addToCart';
        
        if(isset($_COOKIE[$name])){

            $cart = json_decode($_COOKIE[$name], true);
            $totalProducts = 0;
            $totalPriceProducts = 0;
            
            
            foreach($cart as $product => $key){
                
                $itemManager = new ItemManager();
                $productsBasket[] = $itemManager->selectItem($key['productId']);
                $productsBasket[$product]['qty'] = $key['qty'];
                
                $totalProducts += $key['qty']; 
            }
        } 
        
        require "./views/cart.phtml";
    }
    
    function deleteAllCart() {
        
        $name = 'addToCart';
        
        unset($_COOKIE[$name]);
        
        setcookie($name, '', time() - 86400);
        
        require_once "./views/cart.phtml";
    }
    
};    