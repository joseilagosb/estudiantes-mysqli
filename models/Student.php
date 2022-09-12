<?php

class Student
{
  protected $db;

  public function __construct(mysqli $db)
  {
    $this->db = $db;
  }

  public function all_students()
  {
    return mysqli_query($this->db, "SELECT * from students");
  }

  public function add_student($forename, $surname)
  {
    // Sentencia preparada a la cual le insertamos los parámetros por separado
    $stmt = $this->db->prepare("INSERT INTO students(student_no, surname, forename) VALUES (?, ?, ?)");
    $student_no = uniqid();
    $stmt->bind_param("sss", $student_no, $surname, $forename);
    $stmt->execute();
    $stmt->close();
  }
}