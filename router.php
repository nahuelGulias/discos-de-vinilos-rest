<?php 

require_once 'config.php';
require_once 'libs/route.php';

    require_once 'app/controllers/vinilo.api.controller.php';

    $router = new Router();
    #                  endpoint                     verbo      controller          metodo
    $router->addRoute('vinilos',                    'GET',    'ViniloController', 'getVinilos');
    $router->addRoute('vinilos/:ID',                'GET',    'ViniloController', 'getVinilos');
    $router->addRoute('vinilos/:ID/:subrecurso',    'GET',    'ViniloController', 'getVinilos');
    $router->addRoute('vinilos',                    'POST',   'ViniloController', 'insertarVinilo');
    $router->addRoute('vinilos/:ID',                    'PUT',    'ViniloController', 'modificarVinilo');
    // $router->addRoute('vinilos&order-asc=asc',                   'GET',    'ViniloController',  'ordenar');
    // $router->addRoute('vinilos&order-desc=desc',                   'GET',    'ViniloController',  'ordenar');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
