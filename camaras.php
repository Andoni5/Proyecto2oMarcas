<!DOCTYPE html>
<html>
  <head>
    <title>Camaras</title>
    <link rel="icon" type="image/svg" href="images/eye.svg">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <script>
      function redirect(page) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = page;

        var user_input = document.createElement('input');
        user_input.type = 'hidden';
        user_input.name = 'user';
        user_input.value = '<?php echo $_POST['user']; ?>';
        form.appendChild(user_input);

        var pass_input = document.createElement('input');
        pass_input.type = 'hidden';
        pass_input.name = 'pass';
        pass_input.value = '<?php echo $_POST['pass']; ?>';
        form.appendChild(pass_input);

        document.body.appendChild(form);
        form.submit();
      }
    </script>
    <?php
      $pass = $_POST['pass'];
      $user = $_POST['user'];
    ?>
  </head>
  <body>
    <div class="contenedor">
      <div class="menu">
        <ul>
          <?php if ($_POST['user'] == 'Administrador' || $_POST['user'] == 'Controlador' || $_POST['user'] == 'Usuario') { ?>
            <li onclick="redirect('inicio.php')">Home</li>
          <?php } ?>

          <?php if ($_POST['user'] == 'Administrador' || $_POST['user'] == 'Controlador') { ?>
            <li onclick="redirect('camaras.php')">Camaras</li>
          <?php } ?>

          <?php if ($_POST['user'] == 'Administrador' || $_POST['user'] == 'Controlador') { ?>
            <li onclick="redirect('inventario.php')">Inventario</li>
          <?php } ?>

          <?php if ($_POST['user'] == 'Administrador' || $_POST['user'] == 'Controlador' || $_POST['user'] == 'Usuario') { ?>
          <li>Registros
            <ul>
              <li onclick="redirect('registro_puertas.php')">Puertas</li>
              <li onclick="redirect('registro_sensores.php')">Sensores</li>
              <li onclick="redirect('registro_alarmas.php')">Alarmas</li>
            </ul>
          </li>
          <?php } ?>

          <?php if ($_POST['user'] == 'Administrador') { ?>
            <li onclick="redirect('usuarios.php')">Usuarios</li>
          <?php } ?>

          <li style="float:right"><a href="index.php"><?php echo $_POST['user'];?></a></li>
        </ul>
        <!-- Aqui termina el menu -->
        <div class="informacion">
        <div class="puesto_camaras">
        <img src="images/camaras2.jpg" alt="a balloon">
        <div class="camara1"><video loop autoplay muted>
            <source src="videos/video1.mp4" type="video/mp4">
        </video></div>

        <div class="camara2"><video loop autoplay muted>
            <source src="videos/video2.mp4" type="video/mp4">
        </video></div>

        <div class="camara3"><video loop autoplay muted>
            <source src="videos/video3.mp4" type="video/mp4">
        </video></div>

        <div class="camara4"><video loop autoplay muted>
            <source src="videos/video4.mp4" type="video/mp4">
        </video></div>

        <div class="camara5"><video loop autoplay muted>
            <source src="videos/video5.mp4" type="video/mp4">
        </video></div>

        <div class="camara6"><video loop autoplay muted>
            <source src="videos/video6.mp4" type="video/mp4">
        </video></div>


    </div>

        </div>
      </div>
    </div>
  </body>
</html>

