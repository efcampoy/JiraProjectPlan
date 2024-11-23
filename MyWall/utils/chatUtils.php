<?php

/* guarda en un fichero de nombre nombre_fichero el contenido 
que se le pasa como parámetro 

*/

function savePublish($currentUser, $textcontent, $title, $image) {
    $directory = 'users/' . $currentUser . '/';
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true); // Crear la carpeta del usuario con permisos completos
    }

    
    // Generar el nombre del archivo usando solo la marca de tiempo
    $timestamp = microtime(true);
    $file = $directory . $timestamp;

    $fecha = date("Y-m-d H:i:s", $timestamp);
    
    // Contenido para guardar en el fichero
    $contentToSave = $fecha . " " . $currentUser . ": " . $title . PHP_EOL . $textcontent;
    $saveFile = file_put_contents($file . ".txt", $contentToSave);

    // Contenido para guardar en el fichero log.txt en el directorio users
    $contentToSaveLog = $fecha . "El usuario " . $currentUser . " ha hecho una publicación: " . $title . PHP_EOL . $textcontent;
    file_put_contents("users/log.txt", $contentToSaveLog);
    
    

    // Generar la ruta de la imagen usando el tiempo en milisegundos y conservar su extensión
    if($image != null){
        
        $imagePath = $directory . basename($timestamp . '.' . pathinfo($image["name"], PATHINFO_EXTENSION));
        $imageUploaded = move_uploaded_file($image["tmp_name"], $imagePath);
    }

    return $saveFile && $imageUploaded ? $imagePath : false;
}


function loadContent($currentUser) {
    $directory = 'users/' . $currentUser . '/';
    $files = scandir($directory);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $filePath = $directory . $file;
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $content = '';

            // Si el archivo es de texto, leer el contenido
            if (in_array($extension, ['txt'])) {
                $content = nl2br(file_get_contents($filePath)) . "<br><br>";
            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Si el archivo es una imagen, mostrar la etiqueta <img>
                $content = "<img src='$filePath' style='width: 30%;' alt='Image'><br><br>";
                
            }

            echo $content;
        }
    }
}


function requestChat($currentUser, $textcontent, $perfil) {

    $directoryUser = 'users/' . $currentUser . '/' . 'request/';
    $directoryPerfil = 'users/' . $perfil . '/';
   /*  $directoryPerfil = 'users/' . $perfil . '/' . 'request/' . $currentUser . '/'; */

    if (!is_dir($directoryUser) || !is_dir($directoryPerfil)) {
        mkdir($directoryUser, 0777, true); // Crear la carpeta del usuario con permisos completos
        mkdir($directoryPerfil, 0777, true); // Crear la carpeta del usuario con permisos completos
    } 

    
    // Generar el nombre del archivo usando solo la marca de tiempo
    $timestamp = microtime(true);
    $fileUser = $directoryUser . $timestamp;
    $filePerfil = $directoryPerfil . $timestamp;

    $fecha = date("Y-m-d H:i:s", $timestamp);
    
    // Contenido para guardar en el fichero log.txt en el directorio users
    $contentToSaveLog = $fecha . "El usuario " . $currentUser . " el usuario ha respondido: "  . PHP_EOL . $textcontent;
    file_put_contents("users/log.txt", $contentToSaveLog);

    // Contenido para guardar en el fichero
    $contentToSave = $fecha . " " . $currentUser . ": " . $textcontent;
    $contentToSaveMyUser = $fecha . " " . $currentUser . ": " . $textcontent;
    $saveFileUser = file_put_contents($fileUser . ".txt", $contentToSave);
    $saveFilePerfil = file_put_contents($filePerfil . ".txt", $contentToSaveMyUser);


    return $saveFileUser && $saveFilePerfil;
}