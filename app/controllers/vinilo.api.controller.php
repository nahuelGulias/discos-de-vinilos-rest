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


    public function getAllVinilos()
    {   //En caso de venir con filtros/query se muestra segun orden y columna.
        if (isset($_GET['campo']) && isset($_GET['orden'])) {
            if ((($_GET['campo'] == 'id_vinilo') || ($_GET['campo'] == 'vinilo') || ($_GET['campo'] == 'anio_lanzamiento') || ($_GET['campo'] == 'precio')) && ($_GET['orden'] == 'asc') || (($_GET['orden'] == 'desc'))) {
                $campo =  $_GET['campo'];
                $orden = $_GET['orden'];
                $orden = $this->model->ordenar($campo, $orden);
                $this->view->response($orden, 200);
            } else
                $this->view->response('Campos incompletos.', 400);
        } else { //Si no viene ningun parametro/query se muestran todos.
            $vinilos = $this->model->getAllVinilos();
            $this->view->response($vinilos, 200);
        }
    }

    public function getVinilo($params = [])
    { //Obtiene un solo vinilo.
        if (isset($params[':ID'])) {// Si viene solo con :ID, se muestra json completo.
            $vinilo = $this->model->getViniloById($params[':ID']);
            if (!empty($vinilo)) {
                if (isset($params[':subrecurso'])) {//En caso de venir con :ID/:subrecurso.
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
                } else {//Si viene sin :ID se muestra solo.
                    $this->view->response($vinilo, 200);
                }
            } else {
                $this->view->response('No existe vinilo con id = ' . $params[':ID'], 404);
            }
        }
    }


    public function insertarVinilo()
    {
        $body = $this->getData();
        //Controlo que todos los campos esten completos al momento de capturar los datos.
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
            $this->view->response('Vinilo insertado con exito con el id = ' . $viniloInsertado . '.', 201);
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

        $viniloModificado = $this->model->modificarVinilo($precio, $id);
        if($viniloModificado)
            $this->view->response('Modificacion exitosa.', 201);
        else{
            $this->view->response('Modificacion sin exito.', 201);
        }
            
    }
}
