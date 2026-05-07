USE tinacos_db;

CREATE TABLE oee_maquinas (
id INT AUTO_INCREMENT PRIMARY KEY,
fecha DATE,
semana INT,
mes VARCHAR(20),
maquina VARCHAR(50),
turno INT,

tiempo_disponible INT,
paro_molde INT,
comida INT,
paro_mecanico INT,
otros_paros INT,

total_paros INT,
tiempo_operativo INT,

tiempo_ciclo DECIMAL(5,2),
produccion_total INT,
produccion_teorica INT,

defectuosos INT,
buenos INT,

disponibilidad DECIMAL(5,2),
desempeno DECIMAL(5,2),
calidad DECIMAL(5,2),
oee DECIMAL(5,2),

meta_oee DECIMAL(5,2),

causa_paro VARCHAR(50),
observaciones TEXT
);