<?php

class DEvento{
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
        $pre = $con->getcon()->prepare("CALL SPBUSDEL_EVENTO(?,?)");
        $pre->bindValue(1,$bus);
        $pre->bindValue(2,$tipo);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_evento"=>$fila[0],
                "nombre_evento"=>$fila[1],
                "artista"=>$fila[2],
                "categoria"=>$fila[3],
                "ciudad"=>$fila[4],
                "publico"=>$fila[5],
            );
        }
    }
}

?>