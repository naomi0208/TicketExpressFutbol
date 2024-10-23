<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DCategoria.php';

$dpub = new DCategoria();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";
if($tipo=='list'){
    $bus = $_REQUEST["txtbus"];
    $dpub->getList($bus);
    echo json_encode($dpub->getArray());
} elseif ($tipo == 'delete') {
    $id_categoria = $_REQUEST["id_categoria"];
    $dpub->deleteCategoria($id_categoria);
    echo json_encode(array('status' => 'success'));
} elseif ($tipo == 'update') {
    $id_categoria = $_REQUEST["id_categoria"];
    $nombre_categoria = $_REQUEST["nombre_categoria"];
    $dpub->updateCategoria($id_categoria, $nombre_categoria);
    echo json_encode(array('status' => 'success'));
    die();
} elseif ($tipo == 'add') {
    $id_categoria = $_REQUEST["id_categoria"];
    $nombre_categoria = $_REQUEST["nombre_categoria"];
    $dpub->addCategoria($id_categoria, $nombre_categoria);
    echo json_encode(array('status' => 'success'));
    die();
}

?>