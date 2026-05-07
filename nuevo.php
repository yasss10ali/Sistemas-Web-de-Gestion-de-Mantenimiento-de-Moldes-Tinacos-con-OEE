<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">
<?php
session_start();
include("conexion.php");

// Validar que sea operador
if($_SESSION['rol'] != "operador"){
header("Location: login.php");
}

// OBTENER USUARIO QUE INICIÓ SESIÓN
$usuario = $_SESSION['usuario'];

// BUSCAR SU ID EN LA BD
$sql_usuario = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$res_usuario = $conn->query($sql_usuario);
$datos = $res_usuario->fetch_assoc();

// ESTE ES EL ID AUTOMÁTICO
$id_operador = $datos['id_usuario'];

// GUARDAR DATOS
if(isset($_POST['guardar'])){

$fecha = $_POST['fecha'];
$mantenimiento = $_POST['mantenimiento'];
$hora = $_POST['hora'];
$peso = $_POST['peso'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO registros (id_operador,fecha,mantenimiento,hora,peso,cantidad)
VALUES ('$id_operador','$fecha','$mantenimiento','$hora','$peso','$cantidad')";

$conn->query($sql);

echo "Registro guardado correctamente";
}
?>

<link rel="stylesheet" href="estilos.css">

<div class="container">
<h2>Nuevo Registro</h2>

<form method="POST">

Fecha:
<input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

Mantenimiento de moldes:
<select name="mantenimiento">
<option value="SI">SI</option>
<option value="NO">NO</option>
</select>

Hora:
<input type="time" name="hora">

Peso del tinaco:
<input type="number" step="0.01" name="peso">

Cantidad:
<input type="number" name="cantidad">

<button name="guardar">Guardar</button>

</form>

<br>
<a href="operador.php">Regresar</a>
</div>


