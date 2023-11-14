<?php

require_once './app/models/categorys.api.model.php';
require_once './app/views/api.view.php';
require_once './app/controllers/api.controller.php';
require_once './app/helpers/auth.api.helper.php';

class categorysApiController extends ApiController{

    private $model;
    private $view;
    private $authHelper;

    function __construct(){
        parent::__construct();
        $this->model = new caterogysApiModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthHelper();
    }

    
    function getAllCategorys($paramns = null){
        $parametros = [];
        //Funcionalidad Optativa punto 9
        if (isset($_GET['sort'])) {
            $parametros['sort'] = $_GET['sort'];   
            if (isset($_GET['order'])){
                $parametros['order'] = $_GET['order'];   
            }     
            
            if ($this->validarParametrosOrdenamiento($parametros)) {
                $resultado = $this->model->order($parametros['sort'], $parametros['order']);
                $this->view->response($resultado, 200);
            } else {
                $this->view->response("Debe proporcionar un criterio de orden válido", 404);
            }
        }
        //Funcionalidad Optativa punto 8
        else if (isset($_GET['id_periferico'])){
            $parametros['id_periferico'] = $_GET['id_periferico'];  
            
            $id_periferico = $this->model-> getCategorysFiltradas($parametros);

            if($id_periferico!=[]){
                $this ->view->response($id_periferico, 200);
            } else {
                $this ->view->response('No existe la marca= '.$_GET['id_periferico'].'.', 400);
            }
        }
        //Funcionalidad punto 2
        else{
            $perifericos = $this->model->getAll();
            $this->view->response($perifericos,200);
        }
    }


    function getCategory($paramns = null){
        $id_tipo =  $paramns[':ID'];

        $tipo = $this->model->get($id_tipo);

        if ($tipo){
            $this->view->response($tipo,200);
        }
        else{
            $this->view->response("no existe el id que esta buscando",400);
        }
    }


    function deleteCategory($paramns = null){
        $id =  $paramns[':ID'];

        $category = $this->model->get($id);

        if ($category){
           $this->model->delete($id);
           $this->view->response("se elimino con exito id: $id",200);
        }
        else{
            $this->view->response("no existe el id que desea eliminar $id",400);
        }
    }


    function createCategory($params = null) {
        $user = $this->authHelper->currentUser();
        if (!$user){
            $this->view->response('Unauthorized',401);
            return;
        }
        else{

            $body = $this->getData(); 
            $id_periferico = $body->id_periferico;
    
            if (empty ($id_periferico)){
                $this->view->response('ingrese de nuevo sus datos',400);
                return;
            }
    
            $id = $this->model->insertar($id_periferico);
    
            if ($id){
                $this->view->response('La tarea fue insertada con el id='.$id, 201);
            }
            else{
                $this->view->response('La tarea no fue insertada con el id='.$id, 400);
            }
     
        }

    }

    function updatePeriferico($params = null){
        $user = $this->authHelper->currentUser();
        if (!$user){
            $this->view->response('Unauthorized',401);
            return;
        }
        else{
            $id = $params[':ID'];
            $body = $this->getData();
    
            $category = $this->model->get($id);
    
            if ($category){
                $id_periferico = $body->id_periferico;
        
        
                if (empty ($id_periferico) ){
                    $this->view->response('ingrese de nuevo sus datos',400);
                    return;
                }
        
                $this->model->actualizar($id_periferico,$id);
                $this->view->response("se actualizo",200);
            }
            else{
                $this->view->response("no existe en la db el id que desea actualizar",404);
            }
        }
    }



    
    function validarParametrosOrdenamiento($parametros){

        $camposPermitidos = ['id','id_periferico'];
        $ordenesPermitidas = ['asc', 'desc'];
    
        // Validar sort
        if (!isset($parametros['sort']) || !in_array($parametros['sort'], $camposPermitidos)) {
            return false;
        }
    
        // Validar order
        if (!isset($parametros['order']) || !in_array($parametros['order'], $ordenesPermitidas)) {
            return false;
        }
    
        // Si ha pasado ambas validaciones, significa que los parámetros son válidos
        return true;
    }


    
}