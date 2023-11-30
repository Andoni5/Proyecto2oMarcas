<!DOCTYPE html>
<html>
  <head>
    <title>Inicio</title>
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
          <h2>Bienvenido <?php echo $_POST['user'];?></h2>
          <img class="inicio" src="images/test.gif" alt="matrix" width="30%" height="30%">

          <div class="informacion">
            <p>En esta pagina podras ver el estado de los servicios de seguridad.</p>
            <p>Se le recuerda, que por ser usuario de nivel <b>[<?php echo $_POST['user'];?>]</b>, tiene acceso a ciertas tablas.</p>
            <p>Las tablas que tiene acceso son:</p>
            <?php
              $host = 'localhost';
              $dbname = 'camaras';
              $user = $_POST['user'];
              $password = $_POST['pass'];

              try {
                  $dsn = "mysql:host=$host;dbname=$dbname";
                  $pdo = new PDO($dsn, $user, $password);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
                  $sql = "SHOW TABLES";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  echo "<div class='tabla'>";
                  echo "<table>";
                  echo "<tr><th>Tablas</th></tr>";
                  foreach ($result as $row) {
                      echo "<tr><td>";
                      echo $row[0];
                      echo "</td></tr>";
                  }
                  echo "</table>";

                  echo "</div>";
              } catch (PDOException $e) {
                  echo $e->getMessage();
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

