<?php

class DPublico{
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
        $pre = $con->getcon()->prepare("CALL SP_GET_PUBLICOS(?,?)");
        $pre->bindValue(1,$bus);
        $pre->bindValue(2,$tipo);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_publico"=>$fila[0],
                "descripcion"=>$fila[1],
            );
        }
    }

    public function deletePublico($bus) {
        $tipo="D";
        $con=new Conexion();
        $pre=$con->getcon()->prepare("CALL SP_GET_PUBLICOS(?,?)");
        $pre->bindValue(1, $bus);
        $pre->bindValue(2, $tipo);
        if ($pre->execute()) {
            echo "Publico eliminado correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function updatePublico($id_publico, $descripcion) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SP_UPDATE_PUBLICO(?, ?)");
        $pre->bindValue(1, $id_publico);
        $pre->bindValue(2, $descripcion);
        if ($pre->execute()) {
            echo "Publico actualizado correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function addPublico($id_publico, $descripcion) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("INSERT INTO Publico (id_publico, descripcion) VALUES (?, ?)");
        $pre->bindValue(1, $id_publico);
        $pre->bindValue(2, $descripcion);
        if ($pre->execute()) {
            echo "Publico añadido correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }
}

?>