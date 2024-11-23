<!-- Header -->
<header class="header">
    <h1>Panel de Administración</h1>

    <span> <?php echo "Bienvenido: " . $_SESSION["user"]; ?></span>
       

</header>
<!-- Barra lateral -->
<aside class="sidebar">
    <ul>
        
        
        <li><h2>Usuarios</h2></li>
        <li><a href="index.php?perfil=<?php echo $_SESSION['user']; ?>">Responder</a></li>

        <?php
        $members = getAllUser();
        foreach ($members as $user) {
            if (is_dir("users/". $user) && $user != ".." && $user != ".") {

                if($user !== $_SESSION["user"]){
                    
                    echo "<li><a href='index.php?perfil=" . $user . "'>" . $user . "</a></li>";
                }else{
                
                
                }

            }
        }
        ?>
        <li> <!-- Enlace de cierre de sesión que utiliza $_POST para su detección -->
            <?php if (isset($_SESSION["user"])): ?>
                <a href="index.php?access=logout">Cerrar sesión</a>
            <?php endif; ?>
        </li>

    </ul>
</aside>

<!-- Contenido principal -->
<main class="main-content">
    <section class="new">
        <h2>Mis publicaciones</h2>
        <label for="content">Contenido</label>
      
        <div id="content" name="content"><?php if($_SESSION["contador"] == 1){loadContent($_SESSION["user"]);}else{echo $_SESSION["content"];}  ?></div>
    </section>
    <form action="" method="POST" enctype="multipart/form-data">
        <section class="publish">
        <h2>Crear una publicación</h2>
            <!-- Campos del formulario -->
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title">
            <label for="filUpload">Imagen</label>
            <input type="file" name="filUpload" id="filUpload" required title="Requerido para las publicaciones">
            <label for="title">Mensaje</label>
            <input type="text" name="textUpload" id="">
            <input type="submit" value="Publicar" name="publish">
        </form>
    </section>
</main>
<!-- <footer>
  <p>&copy; 2023 Tu sitio web</p>
</footer> -->