<!DOCTYPE html>
<html>
  <head>
    <title>Usuarios</title>
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

      function seleccionarUsuario(selectedValue) {
        actualizar(selectedValue);
      }

      function actualizar(numero) {
      var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'usuarios.php';

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

        var numero_input = document.createElement('input');
        numero_input.type = 'hidden';
        numero_input.name = 'numero';
        numero_input.value = numero;
        form.appendChild(numero_input);
        

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
        
        </div>
        <?php
            $host = 'localhost';
            $dbname = 'camaras';
            $user = $_POST['user'];
            $password = $_POST['pass'];
            $a = 1;
            if (isset($_POST['numero'])) {
              $a = $_POST['numero'];
            }
            try {
                $dsn = "mysql:host=$host;dbname=$dbname";
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM usuarios";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<div class='formbold-form-wrapper'>";
                echo "<div class='formbold-mb-5'>";
                echo "<select
                      name='numero'
                      id='numero'
                      onchange='seleccionarUsuario(this.value)'
                      class='formbold-form-input'>";
                echo "<option value='0'>Seleccione un usuario</option>";
                foreach ($usuarios as $usuario) {
                  echo "<option value='".$usuario['id']."'>".$usuario['nombre']." ".$usuario['apellido']."</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "</div><br><br>";

                $sql = "SELECT * FROM usuarios WHERE id = $a ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Usuario: ".$usuario['nombre']." ".$usuario['apellido']."</h2>";
                echo "<table>";
                echo "<tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Contraseña</th><th>Perfil</th><th>Fecha registro</th><th>Fecha ultimo acceso</th></tr>";
                echo "<tr><td>".$usuario['id']."</td><td>".$usuario['nombre']."</td><td>".$usuario['apellido']."</td><td>".$usuario['email']."</td><td>".$usuario['password']."</td><td>".$usuario['perfil']."</td><td>".$usuario['fecha_registro']."</td><td>".$usuario['fecha_ultimo_acceso']."</td></tr>";
                echo "</table><br>";

            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>