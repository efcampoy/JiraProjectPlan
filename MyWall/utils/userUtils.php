<?php

function existUser(string $username)
{

    // Cargamos en un array asociativo el fichero de usuarios
    $alreadyRegisterUsers = parse_ini_file("users/users.ini");
    // si no existe el archivo devolvemos false
    if ($alreadyRegisterUsers === false) {
        return false;
    }
    // comprobamos si existe el usuario y si no es asi devolvemos false
    return array_key_exists($username, $alreadyRegisterUsers);
}


function loginUser(string $username, string $password)
{

    if (!existUser($username)) {
        return false;
    }

    $user = parse_ini_file("users/users.ini");
    if ($user[$username] === $password) {
        return true;
    }
}

function registerUser($username, $password)
{


    if (existUser($username)) {
        return false;
    }

    $file = fopen("users/users.ini", "a+");
    $write = false;

    if ($file !== false) {

        $write = fwrite($file, "$username=$password" . PHP_EOL);
        fclose($file);
    }

    // Crear una carpeta para el usuario si se escribió correctamente
    if ($write !== false) {

        mkdir("users/" . $username, 0777, true);
    }

    return $write;
}

function getAllUser()
{
    $dir = "users/";

    $a = scandir($dir);

    return  $a;
}

function logout(){

    session_unset();
    // Destruyo la sesión
    session_destroy();
    // Y nos redirigimos a la página de login
    $vista = "login.php";
}
