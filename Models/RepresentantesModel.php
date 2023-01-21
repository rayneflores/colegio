<?php
class RepresentantesModel extends Query {
    public function __construct(){
        parent::__construct();
    }

    public function getRepresentantes(){
        $sql = "SELECT r.id, r.cedula, u.usuario, u.nombre, r.fe_nac, r.direccion, r.telefono FROM representantes r INNER JOIN usuarios u ON u.id = r.id_user WHERE u.estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function modificarRepresentante(int $id, string $fe_nac, int $cedula, string $direccion, string $telefono){
        $this->id = $id;
        $this->fe_nac = $fe_nac;
        $this->cedula = $cedula;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $sql = "UPDATE representantes SET fe_nac = ?, cedula = ?, direccion = ?, telefono = ? WHERE id = ?";
        $datos = array($this->fe_nac, $this->cedula, $this->direccion, $this->telefono, $this->id);
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

    public function editarRepresentante(int $id){
        $sql = "SELECT * FROM representantes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
}