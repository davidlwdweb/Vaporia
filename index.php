<?php 
session_start();

date_default_timezone_set('Europe/Paris');


require_once './configs/Database.php';
require_once './configs/Router.php';

require_once './controllers/HomeController.php';
require_once './controllers/UserController.php';
require_once './controllers/VerifFormController.php';
require_once './controllers/ItemController.php';
require_once './controllers/ContactController.php';
require_once './controllers/AdminController.php';
require_once './controllers/VerifRankController.php';
require_once './controllers/MessageController.php';
require_once './controllers/BasketController.php';


$router = new Router();

if(!isset($_SESSION['categories'])){
    
    $categorieManager = new CategorieManager();
    $_SESSION['categories'] = $categorieManager->selectAllCategories();
}

if(!$router->isAjax()) {
    require_once './views/layout.phtml';
}else {
    $router->callActionFromRequest();
}

?>