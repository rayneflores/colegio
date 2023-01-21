<?php
class Representantes extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'representantes');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar() {
        $data = $this->model->getRepresentantes();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <button title="Editar" class="btn btn-primary" type="button" onclick="btnEditarRepresentante(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
            <a data-toggle="tooltip" title="Representados" class="btn btn-success disabled" href="'.base_url.'Representantes/alumnos/'. $data[$i]['id'] .'"><i class="fas fa-users"></i></a>
            <div/>';        
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'actualizar_representante');
        if(!empty($verificar) || $id_usuario == 1){
            $fe_nac = $_POST['fe_nac'];
            $cedula = $_POST['cedula'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $id = $_POST['id'];
            if (empty($fe_nac) || empty($cedula) || empty($direccion) || empty($telefono)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id != "") {
                    $data = $this->model->modificarRepresentante($id, $fe_nac, $cedula, $direccion, $telefono);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Representante modificado con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el Representante', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Actualizar Representante', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarRepresentante($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}