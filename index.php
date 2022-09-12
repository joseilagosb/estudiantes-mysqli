<?php

include("models/Student.php");

// INDEX CONTROLLER

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  get_index();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  post_index();
}

// FUNCION QUE SE EJECUTA CUANDO ES UNA SOLICITUD GET A LA RUTA /index.php
function get_index()
{
  mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

  // Conexión
  try {
    $db = mysqli_connect('localhost', "root", "", 'school');

    // Inicialización del modelo
    $student_model = new Student($db);

    // Consulta SQL para solicitar todos los estudiantes en la bd
    $todos_los_estudiantes = $student_model->all_students();
  } catch (mysqli_sql_exception $e) {
    // El error se guarda en un arreglo que se puede visiblizar en pantalla por ejemplo
    $error = array(
      "message" => "Error con la base de datos: " . $e->getMessage()
    );
  }
  require_once("views/index.php");
}

// FUNCION QUE SE EJECUTA CUANDO ES UNA SOLICITUD POST A LA RUTA /index.php
function post_index()
{
  mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

  // Conexión
  try {
    $db = mysqli_connect('localhost', "root", "", 'school');

    // Inicialización del modelo
    $student_model = new Student($db);

    // Extraemos de la solicitud POST los dos parámetros que recibimos del formulario
    // Usamos 'htmlspecialchars' para prevenir código malicioso proveniente de los inputs de texto
    $forename = htmlspecialchars($_POST["forename"], ENT_QUOTES, 'UTF-8');
    $surname = htmlspecialchars($_POST["surname"], ENT_QUOTES, 'UTF-8');

    // Consulta SQL de inserción
    $student_model->add_student($forename, $surname);

    // Adicionalmente se seleccionan todos los estudiantes para ser mostrados en la tabla
    $todos_los_estudiantes = $student_model->all_students();
  } catch (mysqli_sql_exception $e) {
    // El error se guarda en un arreglo que se puede visiblizar en pantalla por ejemplo
    $error = array(
      "message" => "Error con la base de datos: " . $e->getMessage()
    );
  }
  require_once("views/index.php");
}