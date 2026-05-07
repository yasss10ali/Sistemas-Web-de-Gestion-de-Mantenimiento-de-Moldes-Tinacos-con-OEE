CREATE TABLE usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
usuario VARCHAR(50),
password VARCHAR(50),
rol VARCHAR(20)
);



INSERT INTO usuarios (usuario, contrasena, rol)
VALUES ('admin', '1234', 'supervisor');
