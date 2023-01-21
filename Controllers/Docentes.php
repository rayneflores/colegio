<?php
class Docentes extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'docentes');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $this->views->getView($this, "asignaturas");
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function asignaturas(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'docentes');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $this->views->getView($this, "asignaturas", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function asignaturas_docente(int $id) {
        $data = $this->model->getAsignaturasDocentesDet();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <a class="btn btn-success" href="'.base_url.'Docentes/lista/'. $data[$i]['id'] .'"><i class="fas fa-book"></i></a>
            <button class="btn btn-primary" type="button" onclick="btnEditarDocente(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
            <div/>';        
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar() {
        $data = $this->model->getDocentes();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <a class="btn btn-success" href="'.base_url.'Docentes/lista/'. $data[$i]['id'] .'"><i class="fas fa-book"></i></a>
            <button class="btn btn-primary" type="button" onclick="btnEditarDocente(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
            <div/>';        
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'actualizar_docente');
        if(!empty($verificar) || $id_usuario == 1){
            $fe_nac = $_POST['fe_nac'];
            $titulo = $_POST['titulo'];
            $institucion = $_POST['institucion'];
            $anio_grad = $_POST['anio_grad'];
            $id = $_POST['id'];
            if (empty($fe_nac) || empty($titulo) || empty($institucion) || empty($anio_grad)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id != "") {
                    $data = $this->model->modificarDocente($id, $fe_nac, $titulo, $institucion, $anio_grad);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el usuario', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Actualizar Docentes', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarDocente($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function lista($id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'establecer_asignaturas');
        if (!empty($verificar) || $id_usuario == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $data['datos'] = $this->model->getAsignaturas();
            $asignaturas = $this->model->getAsignaturasDocente($id);
            $data['asignaturas_establecidas'] = array();
            foreach ($asignaturas as $asignatura) {
                $data['asignaturas_establecidas'][$asignatura['id_asignatura']] = true;
            }
            $data['id_docente'] = $id;
            $this->views->getView($this, "lista", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function establecerAsignaturas() {
        $id_docente = $_POST['id_docente'];
        $eliminar = $this->model->borrarAsignaciones($id_docente);

        if ($eliminar == 'ok') {
            foreach ($_POST['asignaturas'] as $id_asignatura) {
                $resultado = $this->model->establecerAsignaturas($id_docente, $id_asignatura);
                if ($resultado == 'ok') {
                    $msg = array('msg' => 'Asignaturas Configuradas', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Configurar las Asignaturas', 'icono' => 'error');
                }                
            }
        } else {
            $msg = array('msg' => 'Error al Configurar las Asignaturas', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>