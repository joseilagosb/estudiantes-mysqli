<?php

include "models/Mark.php";

// Función ejecutada por el script "index.js" desde la función AJAX

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $student_no = htmlspecialchars($_POST["student_no"], ENT_QUOTES, 'UTF-8');

  mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

  // Conexión
  try {
    $db = mysqli_connect('localhost', "root", "", 'school');

    // Inicialización del modelo
    $mark_model = new Mark($db);

    // Consulta SQL
    $student_marks = $mark_model->get_student_marks($student_no);

    // Se retornarán elementos HTML que desplegarán el conjunto resultado de notas del estudiante
    // Esta es la respuesta que recibirá el cliente desde la solicitud AJAX
    if (mysqli_num_rows($student_marks) == 0) {
      echo "<p>Este estudiante no tiene notas!</p>";
    } else {
      while ($mark = mysqli_fetch_array($student_marks)) {
        echo "<p>" . $mark[0] . ", Nota: " . $mark[1] . "</p>";
      }
    }
  } catch (mysqli_sql_exception $e) {
    exit($e->getMessage());
  }
}