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

/* pour gerer le bouton icone infos */
function InfosEtudiant(event) {
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
document.querySelectorAll("a.infosEtu").forEach(function (lien) {
  lien.addEventListener("click", InfosEtudiant);
});
