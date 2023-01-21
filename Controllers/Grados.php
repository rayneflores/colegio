<?php
class Grados extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'grados');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar(){
        $data = $this->model->getGrados();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarGrado(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'registrar_usuario');
        if(!empty($verificar) || $id_usuario == 1){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            if (empty($nombre)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                    $data = $this->model->registrarGrado($nombre);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Grado registrado con éxito', 'icono' => 'success');
                    } else if ($data == "existe"){
                        $msg = array('msg' => 'El Grado ya existe', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => 'Error al registrar el Grado', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificarGrado($nombre, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Grado modificado con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el Grado', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Registrar Grados', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarGrado($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>