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

// CONSULTAS PARA ESTADÍSTICAS

// Total registros
$r1 = $conn->query("SELECT COUNT(*) as total FROM registros");
$total = $r1->fetch_assoc()['total'];

// Total producción
$r2 = $conn->query("SELECT SUM(cantidad) as suma FROM registros");
$suma = $r2->fetch_assoc()['suma'];

// Total operadores
$r3 = $conn->query("SELECT COUNT(*) as ops FROM usuarios WHERE rol='operador'");
$ops = $r3->fetch_assoc()['ops'];
?>

<link rel="stylesheet" href="dashboard.css">

<div class="sidebar">
    <h2>Supervisor</h2>

    <a href="ver_operadores.php">Operadores</a>
    <a href="ver_tinacos.php">Tinacos</a>
    <a href="graficas.php">Gráficas</a>
    <a href="oee.php">OEE</a>
    <a href="exportar_form.php">Exportar</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">

    <!-- BIENVENIDA -->
    <div class="content">

    <!-- BIENVENIDA -->
    <div class="card">
        <h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>
        <p>Panel de control del supervisor</p>
    </div>

    <!-- EXPORTAR OEE -->
    <div class="card">
        <h3>📊 Exportar Reporte OEE</h3>

        <form action="exportar.php" method="GET">

            <label>Fecha inicio:</label>
            <input type="date" name="inicio" required>

            <label>Fecha fin:</label>
            <input type="date" name="fin" required>

            <br><br>

            <button>Exportar Reporte OEE</button>

        </form>
    </div>

    <!-- ESTADÍSTICAS -->
    <div class="card">
        <h3>Total registros: <?php echo $total; ?></h3>
        <h3>Total producción: <?php echo $suma; ?></h3>
        <h3>Operadores registrados: <?php echo $ops; ?></h3>
        <h3>Fecha actual: <?php echo date('d/m/Y'); ?></h3>
    </div>

</div>

</div>