<!DOCTYPE html>
<html>
  <head>
    <title>Inventario (Add)</title>
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
        <div class="informacion">
        <?php
        $a = 0;
        if (isset($_POST['consulta'])) {
            $a = $_POST['consulta'];
        }
        if ($a == 0) {
        ?>
          <div class="formbold-main-wrapper">
            <div class="formbold-form-wrapper">
              <form action="inventario_add.php" method="POST">
                <input type="hidden" name="consulta" value="1">
                <input type="hidden" name="user" value="<?php echo $user; ?>">
                <input type="hidden" name="pass" value="<?php echo $pass; ?>">

                <div class="formbold-mb-5">
                  <label for="tipo" class="formbold-form-label"> Tipo</label>
                    <select
                      name="tipo"
                      id="tipo"
                      class="formbold-form-input">
                        <option value="puertas">Puerta</option>
                        <option value="sensores">Sensor</option>
                        <option value="alarmas">Alarma</option>
                    </select>
                </div>

                <div class="formbold-mb-5">
                  <label for="name" class="formbold-form-label"> Nombre</label>
                  <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    placeholder="Nombre de la tabla"
                    class="formbold-form-input"
                    required
                  />
                </div>


                <div class="formbold-mb-5">
                  <label for="ubicacion" class="formbold-form-label"> Ubicación </label>
                  <input
                    type="text"
                    name="ubicacion"
                    id="ubicacion"
                    placeholder="Ingresa la ubicación"
                    class="formbold-form-input"
                    required
                  />
                </div>

                <div>
                  <button class="formbold-btn">Añadir entrada</button>
                </div>
              </form>
            </div>
          </div>
        <?php } ?>
        <?php
        if ($a == 1) {
            $host = 'localhost';
            $dbname = 'camaras';
            $user = $_POST['user'];
            $password = $_POST['pass'];

            try {
                $dsn = "mysql:host=$host;dbname=$dbname";
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
                $sql = "INSERT INTO ".$_POST['tipo']." (nombre, ubicacion) VALUES ('".$_POST['nombre']."', '".$_POST['ubicacion']."')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                echo "<script>redirect('inventario.php');</script>";
                
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
        

		} ?>
    <br><br>
    
        </div>
      </div>
    </div>
  </body>
</html>