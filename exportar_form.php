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
    <a href="exportar_form.php" class="active">Exportar</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">

<div class="card">
<h2>📤 Exportar Reporte</h2>

<form action="exportar.php" method="GET" class="form-exportar">

<label>Fecha inicio:</label>
<input type="date" name="inicio" required>

<label>Fecha fin:</label>
<input type="date" name="fin" required>

<button class="btn-exportar">Exportar Excel</button>

</form>

</div>

</div>