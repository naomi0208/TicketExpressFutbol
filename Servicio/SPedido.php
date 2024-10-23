<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DPedido.php';

$dped = new DPedido();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";
if($tipo=='list'){
    $bus = $_REQUEST["txtbus"];
    $dped->getList($bus);
    echo json_encode($dped->getArray());
}