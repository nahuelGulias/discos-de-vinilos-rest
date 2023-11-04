<?php

require_once 'app/controllers/api.controller.php';
require_once 'app/models/vinilo.api.model.php';

    class ViniloController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new ViniloModel();
        }

        public function getVinilos($params = []){
            if(empty($params)){
                $vinilos = $this->model->getVinilos();
                $this->view->response($vinilos,200);
            } else{
                $vinilo = $this->model->getViniloById($params[':ID']);
                if(!empty($vinilo)){
                    if(isset($params[':subrecurso'])){
                        switch($params[':subrecurso']){
                            case 'vinilo':
                                $this->view->response($vinilo->vinilo,200);
                                break;
                            case 'lanzamiento':
                                $this->view->response($vinilo->anio_lanzamiento,200);
                                break;
                            case 'precio':
                                $this->view->response($vinilo->precio,200);
                                break;
                            default:
                                $this->view->response('La tarea no contiene la solicitud:  '. $params[':subrecurso'].'.', 404);
                        }
                    }else{
                        $this->view->response($vinilo,200);
                    }
                }
                else{
                    $this->view->response('No existe vinilo con id = ' . $params[':ID'], 404);
                }
            }
        }

    }