$("form").submit(function (e) {
  e.preventDefault();

  let form = $(this);
  let url = "/page/addCha";
  let data = form.serialize();
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    success: function (response) {
      const rep = response.code;
      if (rep == "200") {
        Swal.fire({icon: "success", title: "Bravo...", text: "Chambre enregistrer avec success!", showConfirmButton: false, timer: 2000});
        $("form")[0].reset();
      }
    }
  });
});
