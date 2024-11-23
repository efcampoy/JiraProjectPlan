<?php

require_once './utils/userUtils.php'; // Esto asegura que solo se incluya una vez

if (isset($_POST["access"])) {


    $access = str_replace(" ", "", strtolower($_REQUEST["access"]));


    switch ($access) {

        case "signin":

            if (loginUser($_POST["user"], $_POST["passwd"])) {

                $_SESSION["user"] = $_POST["user"];
                $view = "menu.php";
            } else {

                $message = "User or password invalid!!";
                $view = "login.php";
            }
            break;

        case "signup":
            if (registerUser($_POST["user"], $_POST["passwd"])) {
                $message = "successfully registered user";
            } else {
                $message = "error when registering";
            }
            break;
    }
}
