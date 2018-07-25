$('footer.chupy-footer form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('footer.chupy-footer form').submit(function(e) {
  kirimSaran()
  return false
})

function kirimSaran(){
  let message = document.querySelector('.chupy-message.cover-message')
  let form = document.querySelector('footer.chupy-footer form')
  let formData = new FormData(form)

  $.ajax({
    url:'/kotak_saran',
    method:'POST',
    dataType:'json',
    contentType:false,
    processData:false,
    data: formData,
    beforeSend:function(response){
      message.classList.toggle("hide",false)
      message.classList.toggle("show",true)
      message.classList.toggle("loading",true)
    }
  }).done(function(response){
    message.classList.toggle("loading",false)

    form.reset()
  }).fail(function(response){
    message.classList.toggle("loading",false)
    message.classList.toggle("error",true)
  })
}
