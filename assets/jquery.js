$(function(){
    $('.question, .saviezVous').hide();

$('#0').click(function(){
  $('#card-1').first().show();
});
$('.answer').on( 'click', function() {
    $(this).parent().next().show();
});
$('.nextButton').click(function(){
  $(this).parent().next().hide();
  $(this).parent().hide();
  $(this).parent().next().next().show();

  });
});
