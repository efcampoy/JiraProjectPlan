<?php
session_start(); // Asegúrate de que la sesión esté iniciada

$path = "view" . DIRECTORY_SEPARATOR;
// Incluir el controlador para procesar el login
if (isset($_POST["access"])) {
    require("./controller/loginController.php");
    // cerrar sesion

}
// Verificar si el usuario está conectado
if (isset($_SESSION["user"])) {
    require("./Utils/chatUtils.php");
    $_SESSION["contador"] = 1;
    $view = "menu.php"; // Cargar menú si el usuario está conectado
} else {
    $view = "login.php"; // Cargar login si no
}
  if (isset($_GET["menu"])) {
    $_SESSION["user"] = $_GET["menu"];
    require_once("./Utils/chatUtils.php");
    require_once("./Utils/userUtils.php");

    $_SESSION["contador"] = 1;
    $view = "menu.php"; // Cargar menú si el usuario está conectado
}   

// Verificar si el usuario ha solicitado cerrar sesión
if (isset($_GET['access']) && $_GET['access'] === 'logout') {

    // Resetear la URL sin parámetros
    require_once("utils/userUtils.php");
    logout();
    $_SESSION["contador"] = 0;
    $urlSinParametros = strtok($_SERVER["REQUEST_URI"], 'i');
    echo "<meta http-equiv='refresh' content='0;URL=$urlSinParametros'>";
}

if (isset($_GET['perfil']) ) {

    $_SESSION["perfil"] = $_GET['perfil'];
    require_once("utils/userUtils.php");
    require("./controller/chatController.php");
    $view = "perfil.php";
    
}

if (isset($_POST["publish"])) {
    require("./controller/chatController.php");
}




?>

<html>

<head>
    <title>index</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <main>
        <?php include $path . "message.php" ?>
        <?php require $path . $view; ?>

    </main>
</body>

</html>