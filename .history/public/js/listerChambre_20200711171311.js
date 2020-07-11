/* pour gerer les bouton next et preview */
function OnclikBtn(event) {
  event.preventDefault();
  const page = this.href;
  $.ajax({
    url: page,
    cache: false,
    success: function (html) {
      afficher(html);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("textStatus");
    }
  });
  return false;
}
/* permet de charger la nouvelle page dans le body */
function afficher(data) {
  $("#body").slideUp(500, function () {
    $("#body").empty();
    $("#body").append(data);
    $("#body").slideDown(1000);
  });
}
document.querySelectorAll("a.page-link").forEach(function (lien) {
  lien.addEventListener("click", OnclikBtn);
});

/* pour gerer le bouton edit */
function ActionChambre(event) {
  event.preventDefault();
  const page = this.href;
  $.ajax({
    url: page,
    cache: false,
    success: function (html) {
      afficher(html);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("textStatus");
    }
  });
  return false;
}
/* permet de charger la nouvelle page dans le body */
function afficher(data) {
  $("#body").slideUp(500, function () {
    $("#body").empty();
    $("#body").append(data);
    $("#body").slideDown(1000);
  });
}
document.querySelectorAll("a.editBtn").forEach(function (lien) {
  lien.addEventListener("click", ActionChambre);
});

/* pour gerer le bouton delete */
$("form").submit(function (e) {
  e.preventDefault();
  var tr = $(this).closest("tr");
  let form = $(this);
  let url = form.attr("action");
  let data = form.serialize();
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then(result => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
          const rep = response.code;
          if (rep == "200") {
            Swal.fire({icon: "success", title: "Bravo...", text: "Chambre supprimer avec success!", showConfirmButton: false, timer: 2000});
            $(tr).hide();
          }
        }
      });
    }
  });
});
