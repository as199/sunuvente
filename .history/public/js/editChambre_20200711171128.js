$("form").submit(function (e) {
  e.preventDefault();

  var id = $("#idcham").val();
  let form = $(this);
  let url = "/page/id/" + id;
  let data = form.serialize();
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    success: function (response) {
      console.log(response);
      const rep = response.code;
      if (rep == "200") {
        Swal.fire({icon: "success", title: "Bravo...", text: "Chambre modifier avec success!", showConfirmButton: false, timer: 2000});
        $("form")[0].reset();
      }
    }
  });
});
