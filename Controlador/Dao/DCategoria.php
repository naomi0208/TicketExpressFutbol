<?php

class DCategoria{
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
        $pre = $con->getcon()->prepare("CALL SP_GET_CATEGORIAS(?,?)");
        $pre->bindValue(1,$bus);
        $pre->bindValue(2,$tipo);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_categoria"=>$fila[0],
                "nombre_categoria"=>$fila[1],
            );
        }
    }

    public function deleteCategoria($bus) {
        $tipo="D";
        $con=new Conexion();
        $pre=$con->getcon()->prepare("CALL SP_GET_CATEGORIAS(?,?)");
        $pre->bindValue(1, $bus);
        $pre->bindValue(2, $tipo);
        if ($pre->execute()) {
            echo "Categoria eliminada correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function updateCategoria($id_categoria, $nombre_categoria) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SP_UPDATE_CATEGORIA(?, ?)");
        $pre->bindValue(1, $id_categoria);
        $pre->bindValue(2, $nombre_categoria);
        if ($pre->execute()) {
            echo "Categoria actualizada correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function addCategoria($id_categoria, $nombre_categoria) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("INSERT INTO Categoria (id_categoria, nombre_categoria) VALUES (?, ?)");
        $pre->bindValue(1, $id_categoria);
        $pre->bindValue(2, $nombre_categoria);
        if ($pre->execute()) {
            echo "Categoria añadida correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }
}

?>