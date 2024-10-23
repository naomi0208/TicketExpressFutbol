DROP DATABASE IF EXISTS BDTicketexpress;
CREATE DATABASE BDTicketexpress;
USE BDTicketexpress;

CREATE TABLE Usuarios (
    id_usuario VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(8) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(15) NOT NULL,
    tipo_usuario ENUM('administrador', 'cliente') NOT NULL
);

CREATE TABLE Categoria (
    id_categoria VARCHAR(10) PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL
);

CREATE TABLE Publico (
    id_publico VARCHAR(10) PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

CREATE TABLE Eventos (
    id_evento VARCHAR(10) PRIMARY KEY,
    nombre_evento VARCHAR(100) NOT NULL,
    artista VARCHAR(100) NOT NULL,
    id_categoria VARCHAR(10),
    ciudad VARCHAR(50) NOT NULL,
    id_publico VARCHAR(10),
    imagen VARCHAR(255) NOT NULL,
    video VARCHAR(255),
    mapa VARCHAR(255),
    spotify VARCHAR(255),
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria),
    FOREIGN KEY (id_publico) REFERENCES Publico(id_publico)
);

CREATE TABLE Zonas (
    id_zona VARCHAR(10) PRIMARY KEY,
    id_evento VARCHAR(10),
    nombre VARCHAR(50) NOT NULL,
    coords VARCHAR(255) NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_evento) REFERENCES Eventos(id_evento)
);

CREATE TABLE Sedes (
    id_sede VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    direccion VARCHAR(255) NOT NULL
);

CREATE TABLE Entradas (
    id_entrada VARCHAR(10) PRIMARY KEY,
    id_zona VARCHAR(10),
    precio DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_zona) REFERENCES Zonas(id_zona)
);

CREATE TABLE Pedidos (
    id_pedido VARCHAR(10) PRIMARY KEY,
    subtotal DECIMAL(10, 2) NOT NULL,
    descuento DECIMAL(10, 2),
    entrega DECIMAL(10, 2),
    total DECIMAL(10, 2) NOT NULL,
    tipo_entrega ENUM('electrónica', 'física') NOT NULL,
    id_sede VARCHAR(10),
    igv DECIMAL(10, 2) NOT NULL,
    pago_final DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_sede) REFERENCES Sedes(id_sede)
);

CREATE TABLE Comprobante (
    id_comprobante VARCHAR(10) PRIMARY KEY,
    id_pedido VARCHAR(10),
    tipo_comprobante ENUM('factura', 'boleta') NOT NULL,
    dni_cliente VARCHAR(15) NOT NULL,
    fecha_emision DATE NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (dni_cliente) REFERENCES Usuarios(dni)
);

CREATE TABLE Detalle_Pedido (
    id_detalle VARCHAR(10) PRIMARY KEY,
    id_pedido VARCHAR(10),
    id_entrada VARCHAR(10),
    cantidad INT NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_entrada) REFERENCES Entradas(id_entrada)
);

/************************************************************************************************/
/**********************************PROCEDIMIENTOS ALMACENADOS************************************/

/*PROCEDIMIENTOS PARA LOS USUARIOS*/

DROP PROCEDURE IF EXISTS SPBUSDEL_USUARIO;

DELIMITER //

CREATE PROCEDURE SPBUSDEL_USUARIO
(IN BUS VARCHAR(20), IN TIPO CHAR(1))
BEGIN
	IF TIPO='B' THEN
    	SELECT * FROM usuarios WHERE ID_USUARIO=BUS OR NOMBRE LIKE CONCAT('%',BUS,'%');
    ELSEIF TIPO='D' THEN
    	DELETE FROM usuarios WHERE ID_USUARIO=BUS;
    END IF;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS SP_UPDATE_USUARIO;
DELIMITER //
CREATE PROCEDURE SP_UPDATE_USUARIO(
    IN p_id_usuario VARCHAR(10),
    IN p_nombre VARCHAR(50),
    IN p_apellido VARCHAR(50),
    IN p_dni VARCHAR(8),
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(15),
    IN p_tipo_usuario ENUM('administrador', 'cliente')
)
BEGIN
    UPDATE Usuarios
    SET 
        nombre = p_nombre,
        apellido = p_apellido,
        dni = p_dni,
        email = p_email,
        password = p_password,
        tipo_usuario = p_tipo_usuario
    WHERE id_usuario = p_id_usuario;
END //

DELIMITER ;

/*PROCEDIMIENTOS PARA LOS EVENTOS*/

DROP PROCEDURE IF EXISTS SPBUSDEL_EVENTO;
DELIMITER //

CREATE PROCEDURE SPBUSDEL_EVENTO (
    IN BUS VARCHAR(20),
    IN TIPO CHAR(1)
)
BEGIN
    IF TIPO = 'B' THEN
        SELECT * FROM eventos WHERE id_evento = BUS OR nombre_evento LIKE CONCAT('%', BUS, '%');
    ELSEIF TIPO = 'D' THEN
        DELETE FROM eventos WHERE id_evento = BUS;
    END IF;
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS SP_GET_EVENTOS;
DELIMITER //

CREATE PROCEDURE SP_GET_EVENTOS (
    IN BUS VARCHAR(20),
    IN TIPO CHAR(1)
)
BEGIN
    IF TIPO = 'B' THEN
        SELECT * FROM eventos WHERE id_evento = BUS OR nombre_evento LIKE CONCAT('%', BUS, '%');
    ELSEIF TIPO = 'D' THEN
        DELETE FROM eventos WHERE id_evento = BUS;
    END IF;
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS SP_UPDATE_EVENTO;
DELIMITER //

CREATE PROCEDURE SP_UPDATE_EVENTO (
    IN p_id_evento VARCHAR(10),
    IN p_nombre_evento VARCHAR(100),
    IN p_artista VARCHAR(100),
    IN p_id_categoria VARCHAR(10),
    IN p_ciudad VARCHAR(50),
    IN p_id_publico VARCHAR(10),
    IN p_imagen VARCHAR(255),
    IN p_video VARCHAR(255),
    IN p_mapa VARCHAR(255),
    IN p_spotify VARCHAR(255)
)
BEGIN
    UPDATE eventos
    SET 
        nombre_evento = p_nombre_evento,
        artista = p_artista,
        id_categoria = p_id_categoria,
        ciudad = p_ciudad,
        id_publico = p_id_publico,
        imagen = p_imagen,
        video = p_video,
        mapa = p_mapa,
        spotify = p_spotify
    WHERE id_evento = p_id_evento;
END //

DELIMITER ;

/*PROCEDIMIENTO PARA LOS PEDIDOS*/

DROP PROCEDURE IF EXISTS SP_GET_PEDIDOS_DETALLES;
DELIMITER //

CREATE PROCEDURE SP_GET_PEDIDOS_DETALLES()
BEGIN
    SELECT 
        p.id_pedido,
        ev.nombre_evento,
        z.nombre AS zona,
        d.cantidad,
        e.precio,
        p.entrega,
        p.tipo_entrega,
        s.nombre AS sede
    FROM 
        pedidos p
    LEFT JOIN 
        detalle_pedido d ON p.id_pedido = d.id_pedido
    LEFT JOIN 
        entradas e ON d.id_entrada = e.id_entrada
    LEFT JOIN 
        zonas z ON e.id_zona = z.id_zona
    LEFT JOIN 
        eventos ev ON z.id_evento = ev.id_evento
    LEFT JOIN 
        sedes s ON p.id_sede = s.id_sede;
END //

DELIMITER ;

CALL SP_GET_PEDIDOS_DETALLES();

/*PROCEDIMIENTO PARA LAS SEDES*/

DROP PROCEDURE IF EXISTS SP_GET_SEDES;

DELIMITER //

CREATE PROCEDURE SP_GET_SEDES
(IN BUS VARCHAR(20), IN TIPO CHAR(1))
BEGIN
	IF TIPO='B' THEN
    	SELECT * FROM sedes WHERE id_sede=BUS OR nombre LIKE CONCAT('%',BUS,'%');
    ELSEIF TIPO='D' THEN
    	DELETE FROM sedes WHERE id_sede=BUS;
    END IF;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS SP_UPDATE_SEDE;
DELIMITER //
CREATE PROCEDURE SP_UPDATE_SEDE(
    IN p_id_sede VARCHAR(10),
    IN p_nombre VARCHAR(50),
    IN p_direccion VARCHAR(255)
)
BEGIN
    UPDATE sedes
    SET 
        nombre = p_nombre,
        direccion = p_direccion
    WHERE id_sede = p_id_sede;
END //
DELIMITER ;

/*PROCEDIMIENTO PARA LAS CATEGORIAS*/

DROP PROCEDURE IF EXISTS SP_GET_CATEGORIAS;

DELIMITER //

CREATE PROCEDURE SP_GET_CATEGORIAS
(IN BUS VARCHAR(20), IN TIPO CHAR(1))
BEGIN
	IF TIPO='B' THEN
    	SELECT * FROM categoria WHERE id_categoria=BUS OR nombre_categoria LIKE CONCAT('%',BUS,'%');
    ELSEIF TIPO='D' THEN
    	DELETE FROM categoria WHERE id_categoria=BUS;
    END IF;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS SP_UPDATE_CATEGORIA;
DELIMITER //
CREATE PROCEDURE SP_UPDATE_CATEGORIA(
    IN p_id_categoria VARCHAR(10),
    IN p_nombre_categoria VARCHAR(50)
)
BEGIN
    UPDATE categoria
    SET 
        nombre_categoria = p_nombre_categoria
    WHERE id_categoria = p_id_categoria;
END //
DELIMITER ;

/*PROCEDIMIENTO PARA LOS PUBLICOS*/

DROP PROCEDURE IF EXISTS SP_GET_PUBLICOS;

DELIMITER //

CREATE PROCEDURE SP_GET_PUBLICOS
(IN BUS VARCHAR(20), IN TIPO CHAR(1))
BEGIN
	IF TIPO='B' THEN
    	SELECT * FROM Publico WHERE id_publico=BUS OR descripcion LIKE CONCAT('%',BUS,'%');
    ELSEIF TIPO='D' THEN
    	DELETE FROM Publico WHERE id_publico=BUS;
    END IF;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS SP_UPDATE_PUBLICO;
DELIMITER //
CREATE PROCEDURE SP_UPDATE_PUBLICO(
    IN p_id_publico VARCHAR(10),
    IN p_descripcion VARCHAR(50)
)
BEGIN
    UPDATE Publico
    SET 
        descripcion = p_descripcion
    WHERE id_publico = p_id_publico;
END //
DELIMITER ;

/*PROCEDIMIENTO PARA LOS COMPROBANTES*/

DROP PROCEDURE IF EXISTS SP_GET_COMPROBANTES_DETALLES;

DELIMITER //

CREATE PROCEDURE SP_GET_COMPROBANTES_DETALLES()
BEGIN
    SELECT 
        c.id_comprobante,
        c.id_pedido,
        c.tipo_comprobante,
        c.dni_cliente,
        c.fecha_emision,
        p.subtotal,
        p.descuento,
        p.entrega,
        p.total,
        p.igv,
        p.pago_final
    FROM 
        Comprobante c
    LEFT JOIN 
        Pedidos p ON c.id_pedido = p.id_pedido;
END //

DELIMITER ;

CALL SP_GET_COMPROBANTES_DETALLES();