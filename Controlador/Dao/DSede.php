<?php

class DSede{
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
        $pre = $con->getcon()->prepare("CALL SP_GET_SEDES(?,?)");
        $pre->bindValue(1,$bus);
        $pre->bindValue(2,$tipo);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_sede"=>$fila[0],
                "nombre"=>$fila[1],
                "direccion"=>$fila[2],
            );
        }
    }

    public function deleteSede($bus) {
        $tipo="D";
        $con=new Conexion();
        $pre=$con->getcon()->prepare("CALL SP_GET_SEDES(?,?)");
        $pre->bindValue(1, $bus);
        $pre->bindValue(2, $tipo);
        if ($pre->execute()) {
            echo "Sede eliminada correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function updateSede($id_sede, $nombre, $direccion) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SP_UPDATE_SEDE(?, ?, ?)");
        $pre->bindValue(1, $id_sede);
        $pre->bindValue(2, $nombre);
        $pre->bindValue(3, $direccion);
        if ($pre->execute()) {
            echo "Sede actualizada correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function addSede($id_sede, $nombre, $direccion) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("INSERT INTO Sedes (id_sede, nombre, direccion) VALUES (?, ?, ?)");
        $pre->bindValue(1, $id_sede);
        $pre->bindValue(2, $nombre);
        $pre->bindValue(3, $direccion);
        if ($pre->execute()) {
            echo "Sede añadida correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }
}

?>