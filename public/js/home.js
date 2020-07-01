$(document).ready(function () {
  $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
  // $("#menu a").click(function () {
  //   page = $(this).attr("href");
  //   $.ajax({
  //     url: page,
  //     cache: false,
  //     success: function (html) {
  //       afficher(html);
  //     },
  //     error: function (XMLHttpRequest, textStatus, errorThrown) {
  //       alert("textStatus");
  //     }
  //   })
  //   return false;
  // });
});

// function afficher(data) {
//   $('#bog').slideUp(500, function () {
//     $("#bog").empty();
//     $("#bog").append(data);
//     $('#bog').slideDown(1000);
//   })

// }
