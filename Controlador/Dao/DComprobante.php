<?php

class DComprobante{
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
        $pre = $con->getcon()->prepare("CALL SP_GET_COMPROBANTES_DETALLES()");
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_comprobante"=>$fila[0],
                "id_pedido"=>$fila[1],
                "tipo_comprobante"=>$fila[2],
                "dni_cliente"=>$fila[3],
                "fecha_emision"=>$fila[4],
                "subtotal"=>$fila[5],
                "descuento"=>$fila[6],
                "entrega"=>$fila[7],
                "total"=>$fila[8],
                "igv"=>$fila[9],
                "pago_final"=>$fila[10],
            );
        }
    }
}

?>