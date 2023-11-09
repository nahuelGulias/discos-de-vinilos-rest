<?php 

require_once 'config.php';
require_once 'libs/route.php';

    require_once 'app/controllers/vinilo.api.controller.php';
    require_once 'app/controllers/artista.api.controller.php';
    $router = new Router();
    #Vinilos           endpoint                     verbo      controller          metodo
    $router->addRoute('vinilos',                    'GET',    'ViniloController', 'getAllVinilos'); //Obtiene todos los vinilos en caso de no indicar orden y columna.
    $router->addRoute('vinilos/:ID',                'GET',    'ViniloController', 'getVinilo'); //Obtiene un solo vinilo.
    $router->addRoute('vinilos/:ID/:subrecurso',    'GET',    'ViniloController', 'getVinilo'); //Obtiene un campo especifico del vinilo .
    $router->addRoute('vinilos',                    'POST',   'ViniloController', 'insertarVinilo'); //Insertar vinilo.
    $router->addRoute('vinilos/:ID',                'PUT',    'ViniloController', 'modificarVinilo'); //Modifica vinilo.
    $router->addRoute('items',                      'GET',    'ViniloController', 'getEntidades'); //??
    #Artistas          endpoint                     verbo      controller          metodo
    $router->addRoute('artistas',                   'GET',    'ArtistaController', 'getAllArtistas'); //Obtiene todos los artistas en caso de no indicar orden y columna.
    $router->addRoute('artistas/:ID',               'GET',    'ArtistaController', 'getArtista'); //Obtiene un solo artista.
    $router->addRoute('artistas/:ID/:subrecurso',   'GET',    'ArtistaController', 'getArtista'); //Obtiene un campo especifico del artista .
    $router->addRoute('artistas',                   'POST',   'ArtistaController', 'insertarArtista'); //Insertar artista.
    $router->addRoute('artistas/:ID',               'PUT',    'ArtistaController', 'modificarArtista'); //Modifica artista.

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
