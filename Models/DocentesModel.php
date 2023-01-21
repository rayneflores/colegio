<?php
class DocentesModel extends Query {
    public function __construct(){
        parent::__construct();
    }

    public function getDocentes(){
        $sql = "SELECT d.id, u.usuario, u.nombre, d.fe_nac, d.titulo, d.institucion, d.anio_grad FROM docentes d INNER JOIN usuarios u ON u.id = d.id_user WHERE u.estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getAsignaturas(){
        $sql = "SELECT a.id, a.nombre as asig_nombre, g.nombre as grad_nombre FROM `asignaturas` a INNER JOIN grados g ON a.id_grado = g.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getAsignaturasDocente(int $id_docente){
        $sql = "SELECT * FROM asignaturas_docentes WHERE id_docente = $id_docente";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getAsignaturasDocentesDet(int $id_docente){
        $sql = "SELECT ad.id as id, u.id as iddoc, u.nombre as doc, a.id as idasi, a.nombre as asign, g.id as idgra, g.nombre as grad FROM asignaturas_docentes ad INNER JOIN docentes d ON d.id = ad.id_docente INNER JOIN usuarios u ON u.id = d.id_user INNER JOIN asignaturas a ON a.id = ad.id_asignatura INNER JOIN grados g ON g.id = a.id_grado WHERE d.id = $id_docente";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function establecerAsignaturas(int $id_docente, int $id_asignatura) {
        $sql = "INSERT INTO asignaturas_docentes (id_docente, id_asignatura) VALUES (?,?)";
        $datos = array($id_docente, $id_asignatura);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function borrarAsignaciones(int $id_docente) {
        $sql = "DELETE FROM asignaturas_docentes WHERE id_docente = ?";
        $datos = array($id_docente);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function editarDocente(int $id){
        $sql = "SELECT * FROM docentes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarDocente(int $id, string $fe_nac, string $titulo, string $institucion, int $anio_grad){
        $this->id = $id;
        $this->fe_nac = $fe_nac;
        $this->titulo = $titulo;
        $this->institucion = $institucion;
        $this->anio_grad = $anio_grad;
        $sql = "UPDATE docentes SET fe_nac = ?, titulo = ?, institucion = ?, anio_grad = ? WHERE id = ?";
        $datos = array($this->fe_nac, $this->titulo, $this->institucion, $this->anio_grad, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }


    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>