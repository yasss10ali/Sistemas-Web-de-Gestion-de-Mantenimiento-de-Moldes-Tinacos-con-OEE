<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">
<?php
session_start();
include("conexion.php");

if(isset($_POST['login'])){

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena'";
$res = $conn->query($sql);

if($res->num_rows > 0){

$datos = $res->fetch_assoc();

$_SESSION['usuario'] = $datos['usuario'];
$_SESSION['rol'] = $datos['rol'];

if($datos['rol']=="operador"){
header("Location: operador.php");
}else{
header("Location: supervisor.php");
}

}else{
$error = "Usuario o contraseña incorrectos";
}
}
?>

<style>
/* FONDO */
body{
margin:0;
font-family:'Segoe UI', sans-serif;
background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
url('fondo.jpg') no-repeat center center/cover;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

/* CONTENEDOR */
.login-box{
background: rgba(255,255,255,0.1);
backdrop-filter: blur(15px);
padding:40px;
border-radius:15px;
width:320px;
box-shadow:0 8px 30px rgba(0,0,0,0.5);
text-align:center;
animation: fadeIn 1s ease;
}

/* ANIMACION */
@keyframes fadeIn{
from{opacity:0; transform:translateY(20px);}
to{opacity:1; transform:translateY(0);}
}

/* TITULO */
.login-box h2{
color:#f8d49d;
margin-bottom:20px;
}

/* INPUTS */
.input-group{
position:relative;
margin-bottom:20px;
}

.input-group input{
width:100%;
padding:12px;
border:none;
border-radius:8px;
outline:none;
background: rgba(255,255,255,0.2);
color:white;
font-size:14px;
}

.input-group input::placeholder{
color:#ddd;
}

/* BOTON */
button{
width:100%;
padding:12px;
border:none;
border-radius:8px;
background:#f8d49d;
color:#0f1e2e;
font-weight:bold;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#e6c07b;
transform:scale(1.05);
}

/* ERROR */
.error{
color:#ff6b6b;
margin-bottom:10px;
font-size:14px;
}
</style>

<div class="login-box">

<h2>Iniciar Sesión</h2>

<?php if(isset($error)){ echo "<div class='error'>$error</div>"; } ?>

<form method="POST">

<div class="input-group">
<input type="text" name="usuario" placeholder="Usuario" required>
</div>

<div class="input-group">
<input type="password" name="contrasena" placeholder="Contraseña" required>
</div>

<button name="login">Entrar</button>

</form>

</div>