$(".see-student-marks").each(function () {
  const student_no = $(this).data("student_no");
  const student_forename = $(this).data("student_forename");
  $(this).on("click", function () {
    $.ajax({
      url: "get_student_marks.php",
      data: { student_no: student_no },
      type: "POST",
      success: function (response) {
        $(".student-marks").fadeIn();
        $(".student-marks .title").html(`Notas de ${student_forename}`);
        $(".student-marks .content").html(response);
      },
    });
  });
});
