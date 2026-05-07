<div class="sidebar">
<?php
session_start();
include("conexion.php");
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="dashboard.css">

<button class="menu-btn" onclick="toggleMenu()">☰</button>

<div class="sidebar">
    <h2>Panel</h2>

    <a href="supervisor.php">Inicio</a>
    <a href="ver_operadores.php">Operadores</a>
    <a href="ver_registros.php">Registros</a>
    <a href="ver_tinacos.php">Tinacos</a>
    <a href="mantenimiento.php" class="active">Mantenimiento y limpieza</a>
    <a href="graficas.php">Gráficas</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">

<div class="card animar">
<h2>🧽 Mantenimiento y limpieza</h2>

<p>Aquí se registrará la información de limpieza y mantenimiento de moldes.</p>

</div>

</div>

<script>
function toggleMenu(){
document.querySelector(".sidebar").classList.toggle("active");
}
</script>