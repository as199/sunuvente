$(document).ready(function () {
  $("#cacheMontant").hide("slow");
  $("#cacheChambre").hide("slow");
  $("#cacheAdresse").hide("slow");
});
$("#etudiant_type").change(function () {
  var type = $("#etudiant_type").val();
  if (type == "nonboursier") {
    $("#cacheAdresse").show("slow");
    $("#cacheMontant").hide("slow");
    $("#cacheChambre").hide("slow");
  }
  if (type == "boursierloger") {
    $("#cacheMontant").show("slow");
    $("#cacheChambre").show("slow");
    $("#cacheAdresse").hide("slow");
  }
  if (type == "boursiernonloger") {
    $("#cacheMontant").show("slow");
    $("#cacheChambre").hide("slow");
    $("#cacheAdresse").hide("slow");
  }
});
$("form").submit(function (e) {
  e.preventDefault();

  let form = $(this);
  let url = "/page/addEtu";
  let data = form.serialize();
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    success: function (response) {
      const rep = response.code;
      if (rep == "200") {
        Swal.fire({icon: "success", title: "Bravo...", text: "Etudiant enregistrer avec success!", showConfirmButton: false, timer: 2000});
        $("form")[0].reset();
      }
    }
  });
});
