<!DOCTYPE html>
<html>
  <head>
    <title>Registro Sensores</title>
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
          <?php
              $host = 'localhost';
              $dbname = 'camaras';
              $user = $_POST['user'];
              $password = $_POST['pass'];

              try {
                  $dsn = "mysql:host=$host;dbname=$dbname";
                  $pdo = new PDO($dsn, $user, $password);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
                  $sql = "SELECT * FROM registros_sensores";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  $sensores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  echo "<h2>Sensores</h2>";
                  echo "<table>";
                  echo "<tr><th>ID</th><th>Sensor</th><th>Fecha</th><th>Hora</th><th>Estado</th></tr>";
                  foreach ($sensores as $sensor) {
                    echo "<tr><td>".$sensor['id']."</td><td>".$sensor['id_sensor']."</td><td>".$sensor['fecha']."</td><td>".$sensor['hora']."</td><td>".$sensor['estado']."</td></tr>";
                  }
                  echo "</table><br>";
              
                } catch (PDOException $e) {
                  echo $e->getMessage();
              }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>

