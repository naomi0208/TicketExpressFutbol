<?php

class DPedido{
    private $data;

    public function getArray(){
        return $this->data;
    }

    public function getsize(){
        return count($this->data);
    }

    public function getItem(){}

    public function getList($bus){
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SP_GET_PEDIDOS_DETALLES()");
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_pedido"=>$fila[0],
                "nombre_evento"=>$fila[1],
                "zona"=>$fila[2],
                "cantidad"=>$fila[3],
                "precio"=>$fila[4],
                "entrega"=>$fila[5],
                "tipo_entrega"=>$fila[6],
                "sede"=>$fila[7],
            );
        }
    }
}

?>