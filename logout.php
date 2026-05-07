<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">
<?php
session_start();
session_destroy();
header("Location: login.php");
?>