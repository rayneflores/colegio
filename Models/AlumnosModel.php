<?php
class AlumnosModel extends Query{
    private $cedula, $nombre, $fe_nac, $sexo, $rep_id;
    public function __construct(){
        parent::__construct();
    }

    public function getAlumnos(){
        $sql = "SELECT al.id, al.cedula, al.nombre, al.fe_nac, al.sexo, al.estado, u.nombre as representante FROM alumnos al INNER JOIN representantes r ON al.id_representante = r.id INNER JOIN usuarios u ON u.id = r.id_user";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRepresentantes(){
        $sql = "SELECT r.id as rep_id, u.nombre FROM representantes r INNER JOIN usuarios u ON r.id_user = u.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarAlumno(string $cedula, string $nombre, string $fe_nac, string $sexo, int $rep_id) {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->fe_nac = $fe_nac;
        $this->sexo = $sexo;
        $this->rep_id = $rep_id;
        $verificar = "SELECT * FROM alumnos WHERE cedula = '$this->cedula' AND nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO alumnos(cedula, nombre, fe_nac, sexo, id_representante) VALUES (?,?,?,?,?)";
            $datos = array($this->cedula, $this->nombre, $this->fe_nac, $this->sexo, $this->rep_id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        } else{
            $res = "existe";
        }
        return $res;
    }

    public function editarAlumno(int $id){
        $sql = "SELECT * FROM alumnos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarAlumno(string $cedula, string $nombre, string $fe_nac, string $sexo, int $rep_id, int $id) {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->fe_nac = $fe_nac;
        $this->sexo = $sexo;
        $this->rep_id = $rep_id;
        $this->id = $id;
        $sql = "UPDATE alumnos SET cedula = ?, nombre = ?, fe_nac = ?, sexo = ?, id_representante = ? WHERE id = ?";
        $datos = array($this->cedula, $this->nombre, $this->fe_nac, $this->sexo, $this->rep_id, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function accionAlumno(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE alumnos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}