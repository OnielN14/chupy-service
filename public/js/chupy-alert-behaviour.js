$(document).ready(function(){

  // alert close button behaviour
  $(function(){
    $("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).removeClass("show");
    });
  });
})
