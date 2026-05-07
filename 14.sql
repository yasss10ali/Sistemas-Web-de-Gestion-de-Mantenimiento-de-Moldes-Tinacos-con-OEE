CREATE TABLE oee_maquinas(

id INT AUTO_INCREMENT PRIMARY KEY,

fecha DATE,
semana VARCHAR(20),
mes VARCHAR(20),

maquina VARCHAR(100),
turno VARCHAR(20),

tiempo_disponible DECIMAL(10,2),

paro_molde DECIMAL(10,2),
comida DECIMAL(10,2),
paro_mecanico DECIMAL(10,2),
otros_paros DECIMAL(10,2),

total_paros DECIMAL(10,2),
tiempo_operativo DECIMAL(10,2),

tiempo_ciclo DECIMAL(10,2),

produccion_total INT,
produccion_teorica INT,

defectuosos INT,
buenos INT,

disponibilidad DECIMAL(10,4),
desempeno DECIMAL(10,4),
calidad DECIMAL(10,4),

oee DECIMAL(10,2),

meta_oee DECIMAL(10,2),

defecto VARCHAR(100),
paro_planeado VARCHAR(100),
paro_no_planeado VARCHAR(100),

observaciones TEXT

);