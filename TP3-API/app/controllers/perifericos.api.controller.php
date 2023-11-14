<?php

require_once './app/models/perifericos.api.model.php';
require_once './app/views/api.view.php';
require_once './app/controllers/api.controller.php';
require_once './app/helpers/auth.api.helper.php';

class PerifericoApiController extends ApiController{

    private $model;
    private $view;

    private $authHelper;

    function __construct(){
        parent::__construct();
        $this->model = new PerifericoApiModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthHelper();
    }

    
    function getAllPeriferico($paramns = null){
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
        else if (isset($_GET['marca'])){
            $parametros['marca'] = $_GET['marca'];  
            
            $marcas = $this->model-> getMarcasFiltradas($parametros);

            if($marcas!=[]){
                $this ->view->response($marcas, 200);
            } else {
                $this ->view->response('No existe la marca= '.$_GET['marca'].'.', 400);
            }
        }
        //Funcionalidad punto 2
        else if (empty($params)){
            $perifericos = $this->model->getAll();
            $this->view->response($perifericos,200);
        }
    
        
        
    }


    function getPeriferico($paramns = null){
        $id_tipo =  $paramns[':ID'];

        $tipo = $this->model->get($id_tipo);

        if ($tipo){
            $this->view->response($tipo,200);
        }
        else{
            $this->view->response("no existe el id que esta buscando",400);
        }
    }


    function deletePeriferico($paramns = null){
        $id =  $paramns[':ID'];

        $periferico = $this->model->get($id);

        if ($periferico){
           $this->model->delete($id);
           $this->view->response("se elimino con exito id: $id",200);
        }
        else{
            $this->view->response("no existe el id que desea eliminar $id",400);
        }
    }


    function createPeriferico($params = null) {
        $user = $this->authHelper->currentUser();
        if (!$user){
            $this->view->response('Unauthorized',401);
            return;
        }
        else{
            $body = $this->getData(); 
            $marca = $body->marca;
            $precio = $body->precio;
            $color = $body->color;
            $id_periferico = $body->id_periferico;
    
            if (empty ($marca) || empty ($precio) ||  empty ($color) ||  empty ($id_periferico) ){
                $this->view->response('ingrese de nuevo sus datos',400);
                return;
            }
    
            $id = $this->model->insertar($marca, $precio, $color,$id_periferico);
    
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
            $this->view->response('Unauhthorized',401);
            return;
        }
        else{
            $id = $params[':ID'];
            $body = $this->getData();

            $periferico = $this->model->get($id);

            if ($periferico){
                $marca = $body->marca;
                $precio = $body->precio;
                $color = $body->color;
                $id_periferico = $body->id_periferico;
        
        
                if (empty ($marca) || empty ($precio) ||  empty ($color) ||  empty ($id_periferico) ){
                    $this->view->response('ingrese de nuevo sus datos',400);
                    return;
                }
        
                $this->model->actualizar($marca,$precio,$color,$id_periferico,$id);
                $this->view->response("se actualizo",200);
            }
            else{
                $this->view->response("no existe en la db el id que desea actualizar",404);
            }
        }
    }



    
    function validarParametrosOrdenamiento($parametros){

        $camposPermitidos = ['id', 'marca', 'precio', 'color','id_periferico'];
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