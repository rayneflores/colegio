<?php
class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $rol_id, $id, $estado;
    public function __construct(){
        parent::__construct();
    }

    public function getUsuario(string $usuario, string $clave){
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave' AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function getRoles(){
        $sql = "SELECT * FROM roles WHERE id > 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getUsuarios(){
        $sql = "SELECT u.*, r.id as id_rol, r.name FROM usuarios u INNER JOIN roles r ON u.rol_id = r.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarUsuario(string $usuario, string $nombre, string $clave, int $rol_id){
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->rol_id = $rol_id;
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios(usuario, nombre, clave, rol_id) VALUES (?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave, $this->rol_id);
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

    public function preDocente(string $usuario) {
        $this->usuario = $usuario;
        $sql = "SELECT id FROM usuarios WHERE usuario = '$this->usuario'";
        $resp = $this->select($sql);
        $sql = "INSERT INTO docentes(fe_nac, institucion, titulo, anio_grad, id_user) VALUES (?,?,?,?,?)";
        $datos = array('', '', '', 0, $resp['id']);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function preRepresentante(string $usuario) {
        $this->usuario = $usuario;
        $sql = "SELECT id FROM usuarios WHERE usuario = '$this->usuario'";
        $resp = $this->select($sql);
        $sql = "INSERT INTO representantes(fe_nac, cedula, direccion, telefono, id_user) VALUES (?,?,?,?,?)";
        $datos = array('', null, '', '', $resp['id']);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function modificarUsuario(string $usuario, string $nombre, int $rol_id, int $id){
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->rol_id = $rol_id;
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, rol_id = ? WHERE id = ?";
        $datos = array($this->usuario, $this->nombre, $this->rol_id, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    
    public function editarUser(int $id){
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function getPass(string $clave, int $id){
        $sql = "SELECT * FROM usuarios WHERE clave = '$clave' AND id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionUser(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function modificarPass(string $password, int $id_usuario){
        $sql = "UPDATE usuarios SET clave = ? WHERE id  = ?";
        $datos = array($password, $id_usuario);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getPermisos(){
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarPermisos(int $id_usuario, int $id_permiso) {
        $sql = "INSERT INTO detalle_permisos (id_usuario, id_permiso) VALUES (?,?)";
        $datos = array($id_usuario, $id_permiso);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function borrarPermisos(int $id_usuario) {
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function getDetallePermisos(int $id_usuario){
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function verificarPermisos(int $id_usuario, string $nombre) {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON d.id_permiso = p.id WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>