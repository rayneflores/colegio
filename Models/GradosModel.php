<?php
class GradosModel extends Query {
    private $grado, $id;

    public function __construct() {
        parent::__construct();
    }

    public function getGrados() {
        $sql = "SELECT * FROM grados";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarGrado(string $nombre) {
        $this->nombre = $nombre;
        $verificar = "SELECT * FROM grados WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO grados(nombre) VALUES (?)";
            $datos = array($this->nombre);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }

    public function modificarGrado(string $nombre, int $id){
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE grados SET nombre = ? WHERE id = ?";
        $datos = array($this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarGrado(int $id){
        $sql = "SELECT * FROM grados WHERE id = $id";
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