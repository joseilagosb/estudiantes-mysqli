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

    // Consulta SQL
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

    $forename = $_POST["forename"];
    $surname = $_POST["surname"];

    // Consulta SQL de inserción
    $student_model->add_student($forename, $surname);

    $todos_los_estudiantes = $student_model->all_students();
  } catch (mysqli_sql_exception $e) {
    // El error se guarda en un arreglo que se puede visiblizar en pantalla por ejemplo
    $error = array(
      "message" => "Error con la base de datos: " . $e->getMessage()
    );
  }
  require_once("views/index.php");
}