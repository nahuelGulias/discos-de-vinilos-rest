<?php

require_once 'app/controllers/api.controller.php';
require_once 'app/models/vinilo.api.model.php';

class ViniloController extends ApiController
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new ViniloModel();
    }

    public function getVinilos($params = [])
    {
        if (empty($params)) {
            $vinilos = $this->model->getVinilos();
            $this->view->response($vinilos, 200);
        } else {
            $vinilo = $this->model->getViniloById($params[':ID']);
            if (!empty($vinilo)) {
                if (isset($params[':subrecurso'])) {
                    switch ($params[':subrecurso']) {
                        case 'vinilo':
                            $this->view->response($vinilo->vinilo, 200);
                            break;
                        case 'lanzamiento':
                            $this->view->response($vinilo->anio_lanzamiento, 200);
                            break;
                        case 'precio':
                            $this->view->response($vinilo->precio, 200);
                            break;
                        default:
                            $this->view->response('La tarea no contiene la solicitud:  ' . $params[':subrecurso'] . '.', 404);
                    }
                } else {
                    $this->view->response($vinilo, 200);
                }
            } else {
                $this->view->response('No existe vinilo con id = ' . $params[':ID'], 404);
            }
        }
    }

    public function insertarVinilo()
    {
        //PREGUNTAR SI PUEDE SER CONST
        $body = $this->getData();

        if (!empty($body->vinilo) || !empty($body->anio_lanzamiento) || !empty($body->precio) || !empty($body->id_artista)) {
            $vinilo = $body->vinilo;
            $lanzamiento = $body->anio_lanzamiento;
            $precio = $body->precio;
            $id_artista = $body->id_artista;
        } else {
            $this->view->response('Campos incompletos.', 404);
        }
        $viniloInsertado = $this->model->insertarVinilo($vinilo, $id_artista, $precio, $lanzamiento);

        if ($viniloInsertado) {
            $this->view->response('Vinilo insertado con exito', 201);
        } else {
            $this->view->response('Error al insertar vinilo', 404);
        }
    }

    public function modificarVinilo($params = [])
    {
        $body = $this->getData();

        if (!empty($body->precio) || !empty($params[':ID'])) {
            $precio = $body->precio;
            $id = $params[':ID'];
        } else {
            $this->view->response('Campos incompletos', 404);
            return;
        }
    
         $this->model->modificarVinilo($precio, $id);
         $this->view->response('Modificacion exitosa', 201);//Esta bien o no pongo nada ? (preguntar )
    }

    //      PREGUNTAR EN CLASE MIERCOLES
    public function ordenar()
    {
        if (isset($_GET['order-asc'])) {
            $this->model->ordenarAsc();
        } else {
            if (isset($_GET['order-desc']))
                $this->model->ordenarDesc();
        }
    }
}
