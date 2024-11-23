<?php

require_once("./utils/chatUtils.php");
require_once("./utils/userUtils.php");

if (isset($_POST["publish"])) {
    
    $title = $_POST["title"] ?? "";
    $text = $_POST["textUpload"];
    $image = $_FILES["filUpload"] ?? "";
    $user = $_SESSION["user"];
    
    if ($_SESSION["contador"] == 1) {
        
        ob_start();
        loadContent($user);
        $_SESSION["content"] = ob_get_clean();
        $_SESSION["contador"]++;
    }
    

    $imagePath = savePublish($user, $text, $title, $image);
    var_dump($imagePath);
    if ($imagePath) {

        $timestamp = microtime(true);
        $fecha = date("Y-m-d H:i:s", $timestamp);
        $newContent = "<img src='$imagePath' style='width: 30%;' alt='Image'><p>$fecha $user: $title</p><p>$text</p>";
        if (isset($_SESSION["content"])) {
            $_SESSION["content"] .= $newContent;
        } else {
            $_SESSION["content"] = $newContent;
        }

        $view = "menu.php";
    }
}

if (isset($_POST["request"])) {

    $text = $_POST["textUpload"];
    $user = $_SESSION["user"];
    $perfil = $_GET['perfil'];

    if ($_SESSION["contador"] == 1) {

        ob_start();
        loadContent($perfil);
        $_SESSION["content"] = ob_get_clean();
        $_SESSION["contador"]++;
    }


    $request = requestChat($user, $text, $perfil);
    if ($request) {

        $timestamp = microtime(true);
        $fecha = date("Y-m-d H:i:s", $timestamp);
        $newContent = "<p>$fecha $user: $text</p>";
        if (isset($_SESSION["content"])) {

            $_SESSION["content"] .= $newContent;
        } else {
            $_SESSION["content"] = $newContent;
        }

        $view = "menu.php";
    }
}

