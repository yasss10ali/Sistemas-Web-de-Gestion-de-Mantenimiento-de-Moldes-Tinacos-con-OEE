<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">
<?php
session_start();

if($_SESSION['rol']!="operador"){
header("Location: login.php");
}
?>

<link rel="stylesheet" href="dashboard.css">

<div class="sidebar">
<h2>Operador</h2>

<a href="nuevo.php">Nuevo registro</a>
<a href="ver_tinacos.php">Tinacos</a>
<a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">
<div class="card">
<h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>
<p>Panel de control del operador</p>
</div>
</div>