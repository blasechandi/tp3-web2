<?php

require_once './app/models/user.api.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth.api.helper.php';


class UserApiController extends ApiController{

    private $model;
    private $view;
    private $authHelper;

    function __construct(){
        parent::__construct();
        $this->model = new UserApiModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthHelper();
    }


    function getToken($params = []) {
        $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

        if(empty($basic)) {
            $this->view->response('No envió encabezados de autenticación.', 401);
            return;
        }

        $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

        if($basic[0]!="Basic") {
            $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            return;
        }

        $userpass = base64_decode($basic[1]); // usr:pass
        $userpass = explode(":", $userpass); // ["usr", "pass"]

        $user = $userpass[0];
        $pass = $userpass[1];

        $userdata = $this->model->getUsuario($user); // Llamar a la DB

        if($user && password_verify($pass, $userdata->password)) {
            // Usuario es válido
            
            $token = $this->authHelper->createToken($userdata);
            $this->view->response($token, 200);
        } else {
            $this->view->response('El usuario o contraseña son incorrectos.', 401);
        }
    }

}