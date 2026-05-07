<?php
session_start();
include("conexion.php");
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="dashboard.css">

<div class="sidebar">
    <h2>Supervisor</h2>

    <a href="ver_operadores.php">Operadores</a>
    <a href="ver_tinacos.php">Tinacos</a>
    <a href="graficas.php">Gráficas</a>
    <a href="oee.php" class="active">OEE</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">
    <div class="card">
<h2>📊 Cálculo OEE</h2>

<form method="POST">

<form method="POST">

<input type="text" name="maquina" placeholder="Nombre de la máquina" required>

<select name="turno" required>
<option value="">Selecciona turno</option>
<option value="1">Primer turno</option>
<option value="2">Segundo turno</option>
<option value="3">Tercer turno</option>
</select>

<input type="date" name="fecha" required>

<input type="number" name="tiempo_planeado" placeholder="Tiempo planeado (min)" required>
<input type="number" name="tiempo_paro" placeholder="Tiempo muerto (min)" required>
<input type="number" name="produccion_total" placeholder="Producción total" required>
<input type="number" name="defectuosos" placeholder="Piezas defectuosas" required>
<input type="number" name="produccion_ideal" placeholder="Producción ideal" required>

<br><br>

<button name="guardar">Guardar y Calcular OEE</button>

</form>
<?php
if(isset($_POST['guardar'])){

$maquina = $_POST['maquina'];
$turno = $_POST['turno'];
$fecha = $_POST['fecha'];
$tp = $_POST['tiempo_planeado'];
$paro = $_POST['tiempo_paro'];
$total = $_POST['produccion_total'];
$def = $_POST['defectuosos'];
$ideal = $_POST['produccion_ideal'];

// CALCULOS
$disponibilidad = ($tp - $paro) / $tp;
$rendimiento = $total / $ideal;
$calidad = ($total - $def) / $total;

$oee = ($disponibilidad * $rendimiento * $calidad) * 100;

// GUARDAR
$conn->query("INSERT INTO oee 
(maquina, turno, fecha, tiempo_planeado, tiempo_paro, produccion_total, defectuosos, produccion_ideal, oee)
VALUES 
('$maquina','$turno','$fecha','$tp','$paro','$total','$def','$ideal','$oee')");

// MOSTRAR
echo "<div class='card'>";
echo "<h2>OEE: ".round($oee,2)."%</h2>";
echo "</div>";
}
?>
<div class="card">
<h3>📅 Filtrar por mes y máquina</h3>

<form method="GET">

<input type="month" name="mes">
<input type="text" name="maquina_buscar" placeholder="Máquina">

<button>Buscar</button>

</form>
</div>
<?php
$where = "";

if(isset($_GET['mes']) && $_GET['mes'] != ""){
    $mes = $_GET['mes'];
    $where .= " AND DATE_FORMAT(fecha, '%Y-%m') = '$mes'";
}

if(isset($_GET['maquina_buscar']) && $_GET['maquina_buscar'] != ""){
    $maq = $_GET['maquina_buscar'];
    $where .= " AND maquina LIKE '%$maq%'";
}

$sql = "SELECT * FROM oee WHERE 1=1 $where";
$res = $conn->query($sql);
?>

<div class="card">
<h3>📊 Historial OEE</h3>

<table border="1" width="100%">
<tr>
<th>Máquina</th>
<th>Turno</th>
<th>Fecha</th>
<th>OEE</th>
</tr>

<?php while($row = $res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['maquina']; ?></td>
<td><?php echo $row['turno']; ?></td>
<td><?php echo $row['fecha']; ?></td>
<td><?php echo round($row['oee'],2); ?>%</td>
</tr>
<?php } ?>

</table>
</div>
</div>
<?php
if(isset($_POST['calcular'])){

$tp = $_POST['tiempo_planeado'];
$paro = $_POST['tiempo_paro'];
$total = $_POST['produccion_total'];
$def = $_POST['defectuosos'];
$ideal = $_POST['produccion_ideal'];

// FORMULAS
$disponibilidad = ($tp - $paro) / $tp;
$rendimiento = $total / $ideal;
$calidad = ($total - $def) / $total;

$oee = $disponibilidad * $rendimiento * $calidad * 100;

// MOSTRAR RESULTADO
echo "<div class='card'>";
echo "<h3>Disponibilidad: ".round($disponibilidad*100,2)."%</h3>";
echo "<h3>Rendimiento: ".round($rendimiento*100,2)."%</h3>";
echo "<h3>Calidad: ".round($calidad*100,2)."%</h3>";
echo "<h2>OEE TOTAL: ".round($oee,2)."%</h2>";
echo "</div>";
}
?>
<div class="card">
<h3>⚠️ Problemas detectados</h3>

<table border="1" width="100%">
<tr>
<th>Problema</th>
<th>Porcentaje</th>
</tr>

<tr><td>Paros</td><td>30%</td></tr>
<tr><td>Defectos</td><td>20%</td></tr>
<tr><td>Baja velocidad</td><td>50%</td></tr>

</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="card">
<canvas id="graficaOEE"></canvas>
</div>

<script>
const ctx = document.getElementById('graficaOEE');

new Chart(ctx, {
type: 'pie',
data: {
labels: ['Paros', 'Defectos', 'Velocidad'],
datasets: [{
data: [30,20,50]
}]
}
});
</script>
</div>