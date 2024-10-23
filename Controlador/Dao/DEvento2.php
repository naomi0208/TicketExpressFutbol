<?php

class DEvento{
    private $data;

    public function getArray(){
        return $this->data;
    }

    public function getsize(){
        return count($this->data);
    }

    public function getItem(){}

    public function getList($bus) {
        $tipo = "B";
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SPBUSDEL_EVENTO(?, ?)");
        $pre->bindValue(1, $bus);
        $pre->bindValue(2, $tipo);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_evento" => $fila[0],
                "nombre_evento" => $fila[1],
                "categoria" => $fila[2],
                "ciudad" => $fila[3],
                "publico" => $fila[4],
                "imagen" => $fila[5],
            );
        }
    }

    public function deleteEvento($bus) {
        $tipo="D";
        $con=new Conexion();
        $pre=$con->getcon()->prepare("CALL SP_GET_EVENTOS(?,?)");
        $pre->bindValue(1, $bus);
        $pre->bindValue(2, $tipo);
        if ($pre->execute()) {
            echo "Evento eliminado correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function updateEvento($id_evento, $nombre_evento, $artista, $id_categoria, $ciudad, $id_publico, $imagen, $video, $mapa, $spotify) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL SP_UPDATE_EVENTO(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $pre->bindValue(1, $id_evento);
        $pre->bindValue(2, $nombre_evento);
        $pre->bindValue(3, $id_categoria);
        $pre->bindValue(4, $ciudad);
        $pre->bindValue(5, $id_publico);
        $pre->bindValue(6, $imagen);
        if ($pre->execute()) {
            echo "Evento actualizado correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function addEvento($id_evento, $nombre_evento, $artista, $id_categoria, $ciudad, $id_publico, $imagen, $video, $mapa, $spotify) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("INSERT INTO Eventos (id_evento, nombre_evento, artista, id_categoria, ciudad, id_publico, imagen, video, mapa, spotify) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $pre->bindValue(1, $id_evento);
        $pre->bindValue(2, $nombre_evento);
        $pre->bindValue(3, $id_categoria);
        $pre->bindValue(4, $ciudad);
        $pre->bindValue(5, $id_publico);
        $pre->bindValue(6, $imagen);
        if ($pre->execute()) {
            echo "Evento añadido correctamente";
        } else {
            print_r($pre->errorInfo());
        }
    }

    public function getBusqueda($busqueda) {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("
            SELECT e.*, c.nombre_categoria, p.descripcion 
            FROM Eventos e
            LEFT JOIN Categoria c ON e.id_categoria = c.id_categoria
            LEFT JOIN Publico p ON e.id_publico = p.id_publico
            WHERE (:categoria IS NULL OR e.id_categoria = :categoria) 
            AND (:ciudad IS NULL OR e.ciudad = :ciudad) 
            AND (:publico IS NULL OR e.id_publico = :publico)
        ");
        $pre->bindValue(':categoria', $busqueda['categoria']);
        $pre->bindValue(':ciudad', $busqueda['ciudad']);
        $pre->bindValue(':publico', $busqueda['publico']);
        $pre->execute();
        foreach ($pre as $fila) {
            $this->data[] = array(
                "id_evento" => $fila['id_evento'],
                "nombre_evento" => $fila['nombre_evento'],
                "categoria" => $fila['nombre_categoria'], // Usar el nombre de la categoría
                "ciudad" => $fila['ciudad'],
                "publico" => $fila['descripcion'], // Usar el nombre del público
                "imagen" => $fila['imagen']
            );
        }
        return $this->data;
    }

    public function getEventoId($id){
        $con = new Conexion();
        $pre = $con->getcon()->prepare("
            SELECT e.*, c.nombre_categoria, p.descripcion 
            FROM Eventos e
            LEFT JOIN Categoria c ON e.id_categoria = c.id_categoria
            LEFT JOIN Publico p ON e.id_publico = p.id_publico
            WHERE e.id_evento = :id_evento
        ");
        $pre->bindValue(':id_evento', $id);
        $pre->execute();
        $evento = $pre->fetch(PDO::FETCH_ASSOC);
        return $evento;
    }
}

?>