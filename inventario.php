<!DOCTYPE html>
<html>
  <head>
    <title>Inventario</title>
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

          <?php if ($_POST['user'] == 'Administrador') { ?>
            <li style="background-color: black; color: white; cursor: pointer;" 
             onclick="redirect('inventario_add.php')"><b>Añadir</b></li>
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
 
                $sql = "SELECT * FROM puertas";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $puertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<h2>Puertas</h2>";
                echo "<table>";
                echo "<tr><th>Id</th><th>Nombre</th><th>Ubicación</th></tr>";
                foreach ($puertas as $puerta) {
                  echo "<tr><td>".$puerta['id']."</td><td>".$puerta['nombre']."</td><td>".$puerta['ubicacion']."</td></tr>";
                }
                echo "</table><br>";

                $sql = "SELECT * FROM sensores";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $sensores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<h2>Sensores</h2>";
                echo "<table>";
                echo "<tr><th>Id</th><th>Nombre</th><th>Ubicación</th></tr>";
                foreach ($sensores as $sensor) {
                  echo "<tr><td>".$sensor['id']."</td><td>".$sensor['nombre']."</td><td>".$sensor['ubicacion']."</td></tr>";
                }
                echo "</table><br>";

                $sql = "SELECT * FROM alarmas";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $alarmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<h2>Alarmas</h2>";
                echo "<table>";
                echo "<tr><th>Id</th><th>Nombre</th><th>Ubicación</th></tr>";
                foreach ($alarmas as $alarma) {
                  echo "<tr><td>".$alarma['id']."</td><td>".$alarma['nombre']."</td><td>".$alarma['ubicacion']."</td></tr>";
                }
                echo "</table>";
                
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>

