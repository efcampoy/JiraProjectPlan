<!-- Header -->
<header class="header">
    <h1>Panel de Administración</h1>

    <span> <?php echo "Bienvenido: " . $_SESSION["user"]; ?></span>
       

</header>
<!-- Barra lateral -->
<aside class="sidebar">
    <ul>


        <li><h2>Usuarios</h2></li>
        <li><a href="index.php?menu=<?php echo $_SESSION['user']; ?>">Publicar algo</a></li>
        <?php
        $members = getAllUser();
        foreach ($members as $user) {
            if (is_dir("users". DIRECTORY_SEPARATOR . $user) && $user != ".." && $user != ".") {

                if($user !== $_SESSION['user']){

                    echo "<li><a href='index.php?perfil=" . $user . "'>" . $user . "</a></li>";
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
        <h2> <?php if($_SESSION['user'] === $_SESSION["perfil"]){echo "Responder mis publicaciones";}else{echo "Nuevas publicaciones de ". $_SESSION["perfil"];}; ?></h2>
        <label for="content">Contenido</label>
      
        <div id="content" name="content"><?php if($_SESSION["contador"] == 1) { loadContent($_SESSION["perfil"]);}else{echo $_SESSION["content"];} ?></div>
    </section>
    <form action="" method="POST">
        <section class="publish">
        <h2>Responder</h2>
            <!-- Campos del formulario -->

            <input type="text" name="textUpload" id="">
            <input type="submit" value="Responder" name="request">
        </form>
    </section>
</main>
<!-- <footer>
  <p>&copy; 2023 Tu sitio web</p>
</footer> -->