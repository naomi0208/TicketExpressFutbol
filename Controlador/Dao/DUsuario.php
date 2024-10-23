<?php

class DUsuario{
    private $data;

    public function getArray(){
        return $this->data;
    }

    public function getsize(){
        return count($this->data);
    }

    public function getItem(){}

    public function getList($bus){
        $tipo="B";
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SPBUSDEL_USUARIO(?,?)");
        $pre->bindValue(1,$bus);
        $pre->bindValue(2,$tipo);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id"=>$fila[0],
                "nombre"=>$fila[1],
                "apellido"=>$fila[2],
                "dni"=>$fila[3],
                "email"=>$fila[4],
                "password"=>$fila[5],
                "tipo_usuario"=>$fila[6],
            );
        }
    }

    public function deleteUser($bus) {
        $tipo="D";
        $con=new Conexion();
        $pre=$con->getcon()->prepare("CALL SPBUSDEL_USUARIO(?,?)");
        $pre->bindValue(1, $bus);
        $pre->bindValue(2, $tipo);
        if ($pre->execute()) {
            echo "Usuario eliminado correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function updateUser($id, $nombre, $apellido, $dni, $email, $password, $tipo_usuario) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SP_UPDATE_USUARIO(?, ?, ?, ?, ?, ?, ?)");
        $pre->bindValue(1, $id);
        $pre->bindValue(2, $nombre);
        $pre->bindValue(3, $apellido);
        $pre->bindValue(4, $dni);
        $pre->bindValue(5, $email);
        $pre->bindValue(6, $password);
        $pre->bindValue(7, $tipo_usuario);
        if ($pre->execute()) {
            echo "Usuario actualizado correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function addUser($id, $nombre, $apellido, $dni, $email, $password, $tipo_usuario) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("INSERT INTO Usuarios (id_usuario, nombre, apellido, dni, email, password, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $pre->bindValue(1, $id);
        $pre->bindValue(2, $nombre);
        $pre->bindValue(3, $apellido);
        $pre->bindValue(4, $dni);
        $pre->bindValue(5, $email);
        $pre->bindValue(6, $password);
        $pre->bindValue(7, $tipo_usuario);
        if ($pre->execute()) {
            echo "Usuario añadido correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function getListFront($email) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("SELECT * FROM Usuarios WHERE email = ?");
        $pre->bindValue(1, $email);
        $pre->execute();
        $this->data = $pre->fetch(PDO::FETCH_ASSOC);
    }
}

?>