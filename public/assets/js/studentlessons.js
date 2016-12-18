$(document).ready(function() {
 
 
  var $rateYo = $("#rateYo").rateYo({
    rating: 2,
    fullStar: true
  });

  $('#rateYo').on('click', function() {
    var rating = $rateYo.rateYo("rating");
    $('')
  });
  

});