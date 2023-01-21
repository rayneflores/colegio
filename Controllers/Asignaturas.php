<?php
class Asignaturas extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'asignaturas');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $data['grados'] = $this->model->getGrados();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar(){
        $data = $this->model->getAsignaturas();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarAsignatura(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'registrar_asignatura');
        if(!empty($verificar) || $id_usuario == 1){
            $asignatura = $_POST['asignatura'];
            $grado = $_POST['grado'];
            $id = $_POST['id'];
            if (empty($asignatura) || empty($grado)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                    $data = $this->model->registrarAsignatura($asignatura, $grado);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Asignatura registrada con éxito', 'icono' => 'success');
                    }else if($data == "existe"){
                        $msg = array('msg' => 'La Asignatura ya existe', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => 'Error al registrar la Asignatura', 'icono' => 'error');
                    }
                }else{
                    $data = $this->model->modificarAsignatura($asignatura, $grado, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Asignatura modificada con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar la Asignatura', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Registrar Asignaturas', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarAsignatura($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>