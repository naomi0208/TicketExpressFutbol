<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DEvento2.php';

$deve = new DEvento();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";

if ($tipo == 'list') {
    $bus = $_REQUEST["txtbus"];
    $deve->getList($bus);
    echo json_encode($deve->getArray());
} elseif ($tipo == 'delete') {
    $id_evento = $_REQUEST["id_evento"];
    $deve->deleteEvento($id_evento);
    echo json_encode(array('status' => 'success'));
} elseif ($tipo == 'update') {
    $id_evento = $_REQUEST["id_evento"];
    $nombre_evento = $_REQUEST["nombre_evento"];
    $artista = $_REQUEST["artista"];
    $id_categoria = $_REQUEST["id_categoria"];
    $ciudad = $_REQUEST["ciudad"];
    $id_publico = $_REQUEST["id_publico"];
    $imagen = $_REQUEST["imagen"];
    $video = $_REQUEST["video"];
    $mapa = $_REQUEST["mapa"];
    $spotify = $_REQUEST["spotify"];
    $deve->updateEvento($id_evento, $nombre_evento, $artista, $id_categoria, $ciudad, $id_publico, $imagen, $video, $mapa, $spotify);
    echo json_encode(array('status' => 'success'));
    die();
} elseif ($tipo == 'add') {
    $id_evento = $_REQUEST["id_evento"];
    $nombre_evento = $_REQUEST["nombre_evento"];
    $artista = $_REQUEST["artista"];
    $id_categoria = $_REQUEST["id_categoria"];
    $ciudad = $_REQUEST["ciudad"];
    $id_publico = $_REQUEST["id_publico"];
    $imagen = $_REQUEST["imagen"];
    $video = $_REQUEST["video"];
    $mapa = $_REQUEST["mapa"];
    $spotify = $_REQUEST["spotify"];
    $deve->addEvento($id_evento, $nombre_evento, $artista, $id_categoria, $ciudad, $id_publico, $imagen, $video, $mapa, $spotify);
    echo json_encode(array('status' => 'success'));
    die();
}

?>