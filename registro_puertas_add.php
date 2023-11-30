<!DOCTYPE html>
<html>
  <head>
    <title>Registro Puertas (Add)</title>
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

      function puerta(estado) {
      if (estado == 'Abierta') {
        document.getElementById('cerrar').play();
      } else {
        document.getElementById('abrir').play();
      }
      
      setTimeout(function() {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'registro_puertas_add.php';

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

        var estado_input = document.createElement('input');
        estado_input.type = 'hidden';
        estado_input.name = 'estado';
        estado_input.value = estado;
        form.appendChild(estado_input);
        

        document.body.appendChild(form);
        form.submit();
      }, 2600);
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
            <li onclick="redirect('inventario.php')">Inventario
              <ul>
                <li onclick="redirect('inventario_add.php')">Añadir</li>
              </ul>
          </li>
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
        <audio id="abrir" src="sonidos/abrir_puerta.mp3" preload="auto"></audio>
        <audio id="cerrar" src="sonidos/cerrar_puerta.mp3" preload="auto"></audio>
        <div class="informacion">
        <?php
            $host = 'localhost';
            $dbname = 'camaras';
            $user = $_POST['user'];
            $password = $_POST['pass'];

            try {
                $dsn = "mysql:host=$host;dbname=$dbname";
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM registros_puertas WHERE id_puerta = 10 ORDER BY id DESC LIMIT 1";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['estado'] == 'Abierta') { ?>
                  <div class='puerta'>
                  <img src="images/puerta_abierta.jpg" onclick="puerta('Abierta')"> 
                  </div>
          <?php } else { ?>
                  <div class='puerta'>
                  <img src="images/puerta_cerrada.jpg" onclick="puerta('Cerrada')">
                  </div>
          <?php }

                if (isset($_POST['estado'])) {
                  $estado = $_POST['estado'];

                  if ($estado == 'Abierta') {
                    $sql = "INSERT INTO registros_puertas (id_puerta, estado, fecha, hora) VALUES (10, 'Cerrada', CURDATE(), CURTIME())";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    echo "<script>redirect('registro_puertas.php')</script>";




                  } elseif ($estado == 'Cerrada') {
                    $sql = "INSERT INTO registros_puertas (id_puerta, estado , fecha, hora) VALUES (10, 'Abierta', CURDATE(), CURTIME())";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    echo "<script>redirect('registro_puertas.php')</script>";
                }
              }

 
               
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
        

        ?>
    <br><br>
    
        </div>
      </div>
    </div>
  </body>
</html>