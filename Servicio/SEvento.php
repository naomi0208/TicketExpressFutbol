<?php

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/Dao/DEvento.php';
require_once '../Modelo/Evento.php';

$deve = new DEvento();
$tipo = isset($_REQUEST["tipo"]) !=null?$_REQUEST["tipo"]:"";
if($tipo=='list'){
    $bus = $_REQUEST["txtbus"];
    $deve->getList($bus);
    echo json_encode($deve->getArray());
}