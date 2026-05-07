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

// BUSCADOR
$busqueda = "";

if(isset($_POST['buscar'])){
    $busqueda = $_POST['busqueda'];
}

// CONSULTA
$sql = "SELECT * FROM usuarios 
WHERE rol='operador' 
AND usuario LIKE '%$busqueda%'";

$res = $conn->query($sql);
?>

<link rel="stylesheet" href="dashboard.css">

<div class="sidebar">
    <h2>Supervisor</h2>

    <a href="supervisor.php">Inicio</a>
    <a href="ver_operadores.php" class="active">Operadores</a>
    <a href="ver_registros.php">Registros</a>
    <a href="ver_tinacos.php">Tinacos</a>
    <a href="graficas.php">Gráficas</a>
    <a href="exportar.php">Exportar</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">

    <div class="card">
        <h2>👷 Operadores</h2>

        <!-- 🔍 BUSCADOR -->
        <form method="POST" class="buscador">
            <input type="text" name="busqueda" placeholder="Buscar operador...">
            <button name="buscar">Buscar</button>
        </form>
    </div>

    <!-- TARJETAS DE OPERADORES -->
    <div class="grid">
        <?php
        while($fila = $res->fetch_assoc()){
        ?>
        <div class="card operador-card">
            <h3><?php echo $fila['usuario']; ?></h3>
            <p>Rol: Operador</p>

            <a href="ver_registros.php?id=<?php echo $fila['id_usuario']; ?>" class="btn-ver">
                Ver registros
            </a>
        </div>
        <?php } ?>
    </div>

</div>