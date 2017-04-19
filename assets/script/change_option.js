function searchOption() {
  var selected = $('.selectS').find(":selected").text();
  $($('.searchT')).attr("placeholder", selected);
}
