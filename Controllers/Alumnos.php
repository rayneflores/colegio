<?php
class Alumnos extends Controller{
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'alumnos');
        if(!empty($verificar) || $id_usuario == 1){
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            $data['representantes'] = $this->model->getRepresentantes();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' .base_url. 'Errors/permisos');
        }
    }

    public function listar(){
        $data = $this->model->getAlumnos();
        for ($i=0; $i < count($data); $i++) {
            if($data[$i]['sexo'] == 'm') {
                $data[$i]['sexo'] = '<span class="badge rounded-pill bg-primary">Masculino</span>';
            } elseif($data[$i]['sexo'] == 'f') {
                $data[$i]['sexo'] = '<span class="badge rounded-pill bg-pink">Femenino</span>';
            } else {
                $data[$i]['sexo'] = '<span class="badge rounded-pill bg-secondary">Otro</span>';
            }
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarAlumno(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarAlumno(' . $data[$i]['id'] . ');"><i class="fas fa-ban"></i></button>
                    <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarAlumno(' . $data[$i]['id'] . ');"><i class="fas fa-check"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'registrar_alumno');
        if (!empty($verificar) || $id_usuario == 1) {
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $fe_nac = $_POST['fe_nac'];
            $sexo = $_POST['sexo'];
            $rep_id = $_POST['rep_id'];
            $id = $_POST['id'];
            if (empty($nombre) || empty($fe_nac) || empty($sexo) || empty($rep_id)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                    $data = $this->model->registrarAlumno($cedula, $nombre, $fe_nac, $sexo, $rep_id);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Alumno registrado con éxito', 'icono' => 'success');
                    } elseif ($data == "existe") {
                        $msg = array('msg' => 'El alumno ya existe', 'icono' => 'warning');
                    } else {
                        $msg = array('msg' => 'Error al registrar el alumno', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificarAlumno($cedula, $nombre, $fe_nac, $sexo, $rep_id, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Alumno modificado con éxito', 'icono' => 'success');
                    }else {
                        $msg = array('msg' => 'Error al modificar el alumno', 'icono' => 'error');
                    }
                }
            }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Registrar Alumnos', 'icono' => 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarAlumno($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermisos($id_usuario, 'eliminar_alumno');
        if(!empty($verificar) || $id_usuario == 1){
            $data = $this->model->accionAlumno(0, $id);
                if ($data == 1) {
                    $msg = array('msg' => 'Alumno dado de baja', 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al Inactivar el Alumno', 'icono' => 'error');
                }
        } else {
            $msg = array('msg' => 'No tienes Permisos para Inactivar Alumnos', 'icono' => 'warning');
        }

        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id){
        $data = $this->model->accionAlumno(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Alumno Activado con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al Activar el Alumno', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}