<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">

<?php
session_start();
include("conexion.php");
$mensaje = "";
// GUARDAR NUEVO
if(isset($_POST['guardar'])){
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];
    $capa1 = $_POST['capa1'];
    $capa2 = $_POST['capa2'];
    $capa3 = $_POST['capa3'];
    $peso = $_POST['peso'];

    $conn->query("INSERT INTO tinacos (codigo,tipo,capa1,capa2,capa3,peso_total)
    VALUES ('$codigo','$tipo','$capa1','$capa2','$capa3','$peso')");

    $mensaje = "Registro guardado correctamente";
}


// ELIMINAR
if(isset($_GET['eliminar'])){
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM tinacos WHERE id_tinaco=$id");
}

// OBTENER DATOS PARA EDITAR
$editar = false;
if(isset($_GET['editar'])){
    $editar = true;
    $id = $_GET['editar'];
    $edit = $conn->query("SELECT * FROM tinacos WHERE id_tinaco=$id")->fetch_assoc();
}

// ACTUALIZAR
if(isset($_POST['actualizar'])){
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];
    $capa1 = $_POST['capa1'];
    $capa2 = $_POST['capa2'];
    $capa3 = $_POST['capa3'];
    $peso = $_POST['peso'];

    $conn->query("UPDATE tinacos SET 
    codigo='$codigo',
    tipo='$tipo',
    capa1='$capa1',
    capa2='$capa2',
    capa3='$capa3',
    peso_total='$peso'
    WHERE id_tinaco=$id");

    $mensaje = "Registro actualizado correctamente";
}

// CONSULTA
$res = $conn->query("SELECT * FROM tinacos");
?>

<link rel="stylesheet" href="dashboard.css">

<div class="sidebar">
    <h2>Panel</h2>

    <a href="supervisor.php">Inicio</a>
    <a href="ver_operadores.php">Operadores</a>
    <a href="ver_registros.php">Registros</a>
    <a href="ver_tinacos.php" class="active">Tinacos</a>
    <a href="mantenimiento.php">Mantenimiento y limpieza</a>
    <a href="graficas.php">Gráficas</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="content">

<div class="card animar">
<h2>🛢️ Tinacos</h2>
<?php if($mensaje != ""){ ?>
<div id="notificacion" class="notificacion">
    <?php echo $mensaje; ?>
</div>
<?php } ?>
<?php if($mensaje != ""){ ?>
<div class="alerta"><?php echo $mensaje; ?></div>
<?php } ?>

<form method="POST" class="form-tinaco">

<?php if($editar){ ?>
<input type="hidden" name="id" value="<?php echo $edit['id_tinaco']; ?>">
<?php } ?>

<input type="text" name="codigo" placeholder="Código de cuerpos rotomoldeados"
value="<?php echo $editar ? $edit['codigo'] : ''; ?>" required>

<input type="text" name="tipo" placeholder="Tipo"
value="<?php echo $editar ? $edit['tipo'] : ''; ?>" required>

<input type="number" step="0.01" name="capa1" placeholder="1er capa (kg)"
value="<?php echo $editar ? $edit['capa1'] : ''; ?>">

<input type="number" step="0.01" name="capa2" placeholder="Espumante (kg)"
value="<?php echo $editar ? $edit['capa2'] : ''; ?>">

<input type="number" step="0.01" name="capa3" placeholder="Capa interna (kg)"
value="<?php echo $editar ? $edit['capa3'] : ''; ?>">

<input type="number" step="0.01" name="peso" placeholder="Peso total (kg)"
value="<?php echo $editar ? $edit['peso_total'] : ''; ?>">

<div class="botones">

<?php if($editar){ ?>
<button name="actualizar" class="btn-guardar">Actualizar</button>
<?php } else { ?>
<button name="guardar" class="btn-guardar">Guardar</button>
<?php } ?>

<button type="button" onclick="limpiarFormulario()" class="btn-nuevo">Nuevo</button>

</div>

</form>
</div>

<div class="card animar">
<table class="tabla-tinacos">
<tr>
<th>Código</th>
<th>Tipo</th>
<th>1er capa (kg)</th>
<th>Espumante (kg)</th>
<th>Capa interna (kg)</th>
<th>Peso total (kg)</th>
<th>Acciones</th>
</tr>

<?php while($fila = $res->fetch_assoc()){ ?>
<tr>
<td><?php echo $fila['codigo']; ?></td>
<td><?php echo $fila['tipo']; ?></td>
<td><?php echo $fila['capa1']; ?></td>
<td><?php echo $fila['capa2']; ?></td>
<td><?php echo $fila['capa3']; ?></td>
<td><?php echo $fila['peso_total']; ?></td>

<td>
<a href="?editar=<?php echo $fila['id_tinaco']; ?>" class="btn-editar">Editar</a>
<a href="?eliminar=<?php echo $fila['id_tinaco']; ?>" class="btn-eliminar"
onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Eliminar</a>
</td>

</tr>
<?php } ?>

</table>
</div>

</div>
<script>

// LIMPIAR FORMULARIO
function limpiarFormulario(){
document.querySelector(".form-tinaco").reset();
}

// CALCULAR PESO AUTOMATICO
function calcularPeso(){
let c1 = parseFloat(document.getElementById("capa1").value) || 0;
let c2 = parseFloat(document.getElementById("capa2").value) || 0;
let c3 = parseFloat(document.getElementById("capa3").value) || 0;

let total = c1 + c2 + c3;

document.getElementById("peso").value = total.toFixed(2);
}

</script>
<script>
function limpiarFormulario(){
document.querySelector(".form-tinaco").reset();
}
</script>
<script>

setTimeout(function(){
let noti = document.getElementById("notificacion");
if(noti){
noti.style.opacity = "0";
noti.style.transform = "translateX(100%)";
setTimeout(() => noti.remove(), 500);
}
}, 3000); // 3 segundos

</script>