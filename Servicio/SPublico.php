<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DPublico.php';

$dcat = new DPublico();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";
if($tipo=='list'){
    $bus = $_REQUEST["txtbus"];
    $dcat->getList($bus);
    echo json_encode($dcat->getArray());
} elseif ($tipo == 'delete') {
    $id_publico = $_REQUEST["id_publico"];
    $dcat->deletePublico($id_publico);
    echo json_encode(array('status' => 'success'));
} elseif ($tipo == 'update') {
    $id_publico = $_REQUEST["id_publico"];
    $descripcion = $_REQUEST["descripcion"];
    $dcat->updatePublico($id_publico, $descripcion);
    echo json_encode(array('status' => 'success'));
    die();
} elseif ($tipo == 'add') {
    $id_publico = $_REQUEST["id_publico"];
    $descripcion = $_REQUEST["descripcion"];
    $dcat->addPublico($id_publico, $descripcion);
    echo json_encode(array('status' => 'success'));
    die();
}

?>