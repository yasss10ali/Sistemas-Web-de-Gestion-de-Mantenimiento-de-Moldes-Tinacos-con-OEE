<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">
<?php
session_start();
include("conexion.php");

// Validar acceso
if(!isset($_SESSION['rol']) || $_SESSION['rol'] != "supervisor"){
    header("Location: login.php");
    exit();
}

// FILTRO POR FECHAS
$fecha_inicio = "";
$fecha_fin = "";

if(isset($_POST['filtrar'])){
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
}

// CONSULTA
$sql = "SELECT registros.*, usuarios.usuario 
FROM registros 
INNER JOIN usuarios ON registros.id_operador = usuarios.id_usuario
WHERE 1";

if(!empty($fecha_inicio) && !empty($fecha_fin)){
    $sql .= " AND fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
}

$res = $conn->query($sql);
?>

<link rel="stylesheet" href="dashboard.css">

<div class="sidebar">
    <h2>Supervisor</h2>

    <a href="supervisor.php">Inicio</a>
    <a href="ver_operadores.php">Operadores</a>
    <a href="ver_tinacos.php">Tinacos</a>
    <a href="graficas.php">Gráficas</a>
    <a href="exportar.php">Exportar</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">

    <div class="card">
        <h2>Registros de Producción</h2>
        <div class="card">
<h3>📤 Exportar reporte</h3>

<form action="exportar.php" method="GET" class="form-exportar">

<label>Fecha inicio:</label>
<input type="date" name="inicio" required>

<label>Fecha fin:</label>
<input type="date" name="fin" required>

<button class="btn-exportar">Exportar Excel</button>

</form>
</div>

        <!-- 📅 FILTRO POR FECHA -->
        <form method="POST" class="filtro-fechas">
            <label>Fecha inicio:</label>
            <input type="date" name="fecha_inicio">

            <label>Fecha fin:</label>
            <input type="date" name="fecha_fin">

            <button name="filtrar">Filtrar</button>
        </form>

        <!-- 📊 TABLA -->
        <table>
            <tr>
                <th>Operador</th>
                <th>Fecha</th>
                <th>Mantenimiento</th>
                <th>Hora</th>
                <th>Peso</th>
                <th>Cantidad</th>
            </tr>

            <?php
            while($fila = $res->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$fila['usuario']."</td>";
                echo "<td>".$fila['fecha']."</td>";

                // 🎨 COLOR EN MANTENIMIENTO
                if($fila['mantenimiento'] == "SI"){
                    echo "<td style='color:green;font-weight:bold;'>SI</td>";
                }else{
                    echo "<td style='color:red;font-weight:bold;'>NO</td>";
                }

                echo "<td>".$fila['hora']."</td>";
                echo "<td>".$fila['peso']."</td>";
                echo "<td>".$fila['cantidad']."</td>";
                echo "</tr>";
            }
            ?>
        </table>

    </div>

</div>