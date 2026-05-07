<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include("conexion.php");

$sql = "SELECT id_operador, SUM(cantidad) as total FROM registros GROUP BY id_operador";
$res = $conn->query($sql);

$datos = [];

while($fila = $res->fetch_assoc()){
$datos[] = $fila['total'];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h2>Producción de Tinacos</h2>

<canvas id="grafica"></canvas>

<script>
var ctx = document.getElementById('grafica').getContext('2d');

var grafica = new Chart(ctx, {
type: 'bar',
data: {
labels: ['Operador 1','Operador 2','Operador 3'],
datasets: [{
label: 'Cantidad',
data: <?php echo json_encode($datos); ?>,
borderWidth: 1
}]
}
});
</script>