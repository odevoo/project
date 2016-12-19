var $rateYo = [];
$(document).ready(function() {
    
    var id_lesson = 0;
    $(".rateYo").each(function () {
    var current_id = $(this).data('id'); 
      
    $rateYo[current_id] = $(this).rateYo({
    rating: 2,
    fullStar: true
  });
}); 
  $('.rating').on('click', function() {
    id_lesson = $(this).data('id');
  });

  $('.rateYo').on('click', function() {
    var rating = $rateYo[id_lesson].rateYo("rating");
    console.log('rating: ' + rating);
    console.log('id_lesson: ' + id_lesson);
    $('#ratingnote' + id_lesson ).val(rating);
  });
  

});