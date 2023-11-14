<?php
    require_once 'config.php';
    require_once 'libs/router.php';
    require_once 'app/controllers/perifericos.api.controller.php';
    require_once 'app/controllers/categorys.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';



    $router = new Router();

    #                 endpoint            verbo               controller           método
    $router->addRoute('periferico',     'GET',    'PerifericoApiController', 'getAllPeriferico');
    $router->addRoute('periferico/:ID', 'GET',    'PerifericoApiController', 'getPeriferico'   );
    $router->addRoute('periferico/:ID', 'DELETE', 'PerifericoApiController', 'deletePeriferico');
    $router->addRoute('periferico', 'POST',   'PerifericoApiController', 'createPeriferico');
    $router->addRoute('periferico/:ID', 'PUT',    'PerifericoApiController', 'updatePeriferico');

    //categorys
    #                 endpoint            verbo               controller           método
    $router->addRoute('categoria',      'GET',    'categorysApiController', 'getAllCategorys');
    $router->addRoute('categoria/:ID',  'GET',    'categorysApiController', 'getCategory'   );
    $router->addRoute('categoria/:ID',  'DELETE', 'categorysApiController', 'deleteCategory');
    $router->addRoute('categoria',      'POST',   'categorysApiController', 'createCategory');
    $router->addRoute('categoria/:ID',  'PUT',    'categorysApiController', 'updatePeriferico');



    $router->addRoute('user/token',  'GET',    'UserApiController', 'getToken');


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);