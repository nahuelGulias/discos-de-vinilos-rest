<?php 

require_once 'config.php';
require_once 'libs/route.php';

    require_once 'app/controllers/vinilo.api.controller.php';

    $router = new Router();
    #                  endpoint                 verbo      controller                  metodo
    $router->addRoute('vinilos',                'GET',    'ViniloController', 'getVinilos');
    $router->addRoute('vinilos/:ID',            'GET',    'ViniloController', 'getVinilos');
    $router->addRoute('vinilos/:ID/:subrecurso', 'GET',    'ViniloController', 'getVinilos');
    

   // $router->addRoute('tareas/:ID/:subrecurso', 'GET',    'TaskApiController', 'get'   );
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
