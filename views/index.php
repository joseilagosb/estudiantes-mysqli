<!DOCTYPE html>
<html lang="en">

<!-- INDEX VIEW -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba BD PDO</title>

  <link rel="stylesheet" href="assets/styles/global.css" type="text/css">
  <link rel="stylesheet" href="assets/styles/index.css" type="text/css">

</head>

<body>
  <div class="wrapper">
    <!-- Si ocurrió un error... -->
    <?php if (isset($error)) { ?>
    <div class="error-message">
      <?php echo $error["message"] ?>
    </div>
    <!-- Sino ejecutar lo siguiente -->
    <?php } else { ?>
    <h2 class="page-title">RECUENTO DE ESTUDIANTES</h2>
    <div class="card">
      <?php while ($estudiante = mysqli_fetch_array($todos_los_estudiantes)) { ?>
      <div class="student-row">
        <h5 class="name"><?= $estudiante[2] . " " . $estudiante[1] ?></h5>
        <button data-student_forename="<?= $estudiante[2] ?>" data-student_no="<?= $estudiante[0] ?>"
          class="see-student-marks">Ver notas del estudiante</button>
      </div>
      <?php } ?>
      <div class="student-marks">
        <div class="title"></div>
        <div class="content"></div>
      </div>
    </div>
    <div class="card">
      <h3 class="title">Agregar estudiante</h3>
      <form class="form" method="POST" action="index.php">
        <div class="field">
          <label for="forename">Nombre</label>
          <input id="forename" name="forename"></input>
        </div>
        <div class="field">
          <label for="surname">Apellido</label>
          <input id="surname" name="surname"></input>
        </div>
        <button class="submit" type="submit">Enviar</button>
      </form>
    </div>
    <?php } ?>
  </div>
</body>

<script src="assets/scripts/jquery.min.js"></script>
<script src="assets/scripts/index.js"></script>

</html>