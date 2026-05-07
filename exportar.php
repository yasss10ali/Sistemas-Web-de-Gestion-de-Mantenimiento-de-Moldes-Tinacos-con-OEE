<?php
include("conexion.php");

$inicio = $_GET['inicio'] ?? '';
$fin = $_GET['fin'] ?? '';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_OEE.xls");

// CONSULTA
$sql = "SELECT * FROM oee WHERE fecha BETWEEN '$inicio' AND '$fin'";
$res = $conn->query($sql);

$total = 0;
$count = 0;

echo "<h2>REPORTE OEE</h2>";
echo "<p>Desde: $inicio | Hasta: $fin</p>";

echo "<table border='1'>
<tr>
<th>Máquina</th>
<th>Turno</th>
<th>Fecha</th>
<th>OEE (%)</th>
</tr>";

while($row = $res->fetch_assoc()){
    echo "<tr>
    <td>{$row['maquina']}</td>
    <td>{$row['turno']}</td>
    <td>{$row['fecha']}</td>
    <td>".round($row['oee'],2)."</td>
    </tr>";

    $total += $row['oee'];
    $count++;
}

echo "</table>";

$promedio = $count > 0 ? $total/$count : 0;

echo "<h3>Promedio OEE: ".round($promedio,2)."%</h3>";

// ANALISIS
echo "<h3>ANÁLISIS:</h3>";

if($promedio >= 85){
    echo "<p style='color:green;'>Excelente eficiencia</p>";
}
elseif($promedio >= 60){
    echo "<p style='color:orange;'>Eficiencia media</p>";
}
else{
    echo "<p style='color:red;'>Baja eficiencia</p>";
}

// GRAFICA VISUAL (BARRA)
echo "<h3>Gráfica OEE</h3>";

$barra = round($promedio);

echo "<div style='width:300px; background:#ddd;'>
        <div style='width:{$barra}%; background:green; color:white;'>
        {$barra}%
        </div>
      </div>";

// PROBLEMAS
echo "<h3>Problemas</h3>";

echo "<table border='1'>
<tr><th>Problema</th><th>%</th></tr>
<tr><td>Paros</td><td>30%</td></tr>
<tr><td>Defectos</td><td>20%</td></tr>
<tr><td>Baja velocidad</td><td>50%</td></tr>
</table>";