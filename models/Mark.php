<?php

class Mark
{
  protected $db;

  public function __construct(mysqli $db)
  {
    $this->db = $db;
  }

  public function get_student_marks($student_no)
  {
    return mysqli_query($this->db, "SELECT module_name, mark from marks, modules WHERE marks.student_no = '" . $student_no . "';");
  }
}