$(document).ready(function () {
  $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
  /*****/
});

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
  $("#body").slideUp(50, function () {
    $("#body").empty();
    $("#body").append(data);
    // $('#body').slideDown(1000);
  });
}
document.querySelectorAll("a#menu").forEach(function (lien) {
  lien.addEventListener("click", OnclikBtn);
});

/*** logout******/
function logout(event) {
  event.preventDefault();
  const url = "/logout";
  alert(url);
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
        success: function (response) {
          window.location.href = "/login";
        }
      });
    }
  });
}

document.querySelectorAll("a#menu1").forEach(function (lien) {
  lien.addEventListener("click", logout);
});
