<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DUsuario.php';

$dusu = new DUsuario();
$tipo = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "";

if ($tipo == 'list') {
    $bus = $_REQUEST["txtbus"];
    $dusu->getList($bus);
    echo json_encode($dusu->getArray());
} elseif ($tipo == 'delete') {
    $id = $_REQUEST["id"];
    $dusu->deleteUser($id);
    echo json_encode(array('status' => 'success'));
} elseif ($tipo == 'update') {
    $id = $_REQUEST["id"];
    $nombre = $_REQUEST["nombre"];
    $apellido = $_REQUEST["apellido"];
    $dni = $_REQUEST["dni"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $tipo_usuario = $_REQUEST["tipo_usuario"];
    $dusu->updateUser($id, $nombre, $apellido, $dni, $email, $password, $tipo_usuario);
    echo json_encode(array('status' => 'success'));
    die();
} elseif ($tipo == 'add') {
    $id = $_REQUEST["id"];
    $nombre = $_REQUEST["nombre"];
    $apellido = $_REQUEST["apellido"];
    $dni = $_REQUEST["dni"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $tipo_usuario = $_REQUEST["tipo_usuario"];

    $dusu->addUser($id, $nombre, $apellido, $dni, $email, $password, $tipo_usuario);
    echo json_encode(array('status' => 'success'));
    die();
}

?>