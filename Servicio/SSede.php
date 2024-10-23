<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DSede.php';

$dsede = new DSede();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";
if($tipo=='list'){
    $bus = $_REQUEST["txtbus"];
    $dsede->getList($bus);
    echo json_encode($dsede->getArray());
} elseif ($tipo == 'delete') {
    $id_sede = $_REQUEST["id_sede"];
    $dsede->deleteSede($id_sede);
    echo json_encode(array('status' => 'success'));
} elseif ($tipo == 'update') {
    $id_sede = $_REQUEST["id_sede"];
    $nombre = $_REQUEST["nombre"];
    $direccion = $_REQUEST["direccion"];
    $dsede->updateSede($id_sede, $nombre, $direccion);
    echo json_encode(array('status' => 'success'));
    die();
} elseif ($tipo == 'add') {
    $id_sede = $_REQUEST["id_sede"];
    $nombre = $_REQUEST["nombre"];
    $direccion = $_REQUEST["direccion"];
    $dsede->addSede($id_sede, $nombre, $direccion);
    echo json_encode(array('status' => 'success'));
    die();
}

?>