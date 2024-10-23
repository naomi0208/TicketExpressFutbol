<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DComprobante.php';

$dsede = new DComprobante();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";
if($tipo=='list'){
    $bus = $_REQUEST["txtbus"];
    $dsede->getList($bus);
    echo json_encode($dsede->getArray());
}