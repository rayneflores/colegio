<?php
class AsignaturasModel extends Query {
    private $asignatura, $id;

    public function __construct() {
        parent::__construct();
    }

    public function getAsignaturas() {
        $sql = "SELECT a.*, g.nombre as grado FROM asignaturas a INNER JOIN grados g ON g.id = a.id_grado";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getGrados(){
        $sql = "SELECT * FROM grados";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarAsignatura(string $nombre, int $grado_id){
        $this->nombre = $nombre;
        $this->grado_id = $grado_id;
        $verificar = "SELECT * FROM asignaturas WHERE nombre = '$this->nombre' AND id_grado = $this->grado_id";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO asignaturas(nombre, id_grado) VALUES (?,?)";
            $datos = array($this->nombre, $this->grado_id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }

    public function modificarAsignatura(string $nombre, int $grado_id, int $id) {
        $this->nombre = $nombre;
        $this->id = $id;
        $this->grado_id = $grado_id;
        $sql = "UPDATE asignaturas SET nombre = ?, id_grado = ? WHERE id = ?";
        $datos = array($this->nombre, $this->grado_id, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarAsignatura(int $id){
        $sql = "SELECT * FROM asignaturas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>