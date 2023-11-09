<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/artista.api.model.php';
class ArtistaController extends ApiController
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new ArtistaModel();
    }

    public function getAllArtistas()
    {
        if (isset($_GET['campo']) && isset($_GET['orden'])) {
            if ((($_GET['campo'] == 'id_artista') || ($_GET['campo'] == 'artista') || ($_GET['campo'] == 'anio_nac') || ($_GET['campo'] == 'descripcion')) && ($_GET['orden'] == 'asc') || (($_GET['orden'] == 'desc'))) {
                $campo =  $_GET['campo'];
                $orden = $_GET['orden'];
                $orden = $this->model->ordenar($campo, $orden);
                $this->view->response($orden, 200);
            } else{
                $this->view->response('Campos incompletos.', 400);
            }
        } else {
            $artistas = $this->model->getAllArtistas();
            $this->view->response($artistas, 200);
        }
    }
    public function getArtista($params = [])
    {
        if (!isset($_GET[$params[':ID']])) {
            $artista = $this->model->getArtistaById($params[':ID']);
            if (!empty($artista)) {
                if (isset($params[':subrecurso'])) {
                    switch ($params[':subrecurso']) {
                        case 'artista':
                            $this->view->response($artista->artista, 200);
                            break;
                        case 'nacimiento':
                            $this->view->response($artista->anio_nac, 200);
                            break;
                        case 'descripcion':
                            $this->view->response($artista->descripcion, 200);
                            break;
                        default:
                            $this->view->response('La tarea no contiene la solicitud:  ' . $params[':subrecurso'] . '.', 404);
                    }
                } else {
                    $this->view->response($artista, 200);
                }
            } else {
                $this->view->response('No existe artista con id = ' . $params[':ID'], 404);
            }
        }
    }
    public function insertarArtista()
    {
        $body = $this->getData();
        if (!empty($body->artista) || !empty($body->anio_nac) || !empty($body->descripcion)) {
            $artista = $body->artista;
            $anio = $body->anio_nac;
            $desc = $body->descripcion;
        } else {
            $this->view->response('Campos incompletos', 404);
            return;
        }

        $art = $this->model->modificarArtista($artista, $anio, $desc);
        if ($art) {
            $this->view->response('Artista insertado con exito', 200);
        } else {
            $this->view->response('Erros al insertar', 404);
        }
    }

    public function modificarArtista($params = [])
    {
        $body = $this->getData();
        if (!empty($body->descripcion) || !empty($params[':ID'])) {
            $desc = $body->descripcion;
            $id = $params[':ID'];
        } else {
            $this->view->response('Campos incompletos', 404);
            return;
        }
        $this->model->modificarArtista($desc, $id);
        $this->view->response('Modificado con exito', 200);
    }
}