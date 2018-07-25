// disable normal form behaviour
$('form#form-registrasi').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-registrasi').submit(function(e) {
  registrasi();
  return false
})

function registrasi(){
  let form = document.querySelector('form#form-registrasi')
  let formData = new FormData(form)


  $.ajax({
    url:'/api/pengguna/tambah',
    method:'POST',
    dataType: 'json',
    contentType: false,
    processData: false,
    data:formData,
    beforeSend:function(response){
      $('#chupy-msg').removeClass('show')
      $('#chupy-msg').removeClass('alert-warning')
      $('#chupy-msg').removeClass('alert-primary')
      $('#chupy-msg').removeClass('alert-danger')
      $('#chupy-msg').removeClass('alert-success')

      $('.loading-screen').addClass('show')

      $('#chupy-msg').find('strong').text('Harap tunggu')
      $('#chupy-msg').find('strong + span').text('Permintaan sedang diproses..')

      $('#chupy-msg').addClass('alert-primary')
      $('#chupy-msg').addClass('show')

      window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
      });
    }
  }).done(function(reponse){
    $('#chupy-msg').addClass('alert-success')

    $('#chupy-msg').find('strong').text('Sukses')
    $('#chupy-msg').find('strong + span').text('Registrasi berhasil.')
    $('#chupy-msg').addClass('show')
    setTimeout(function() {
      window.location = '/registrasi/berhasil?key='+$('input[name="front_end_key"]').val()
    }, 1000)

  }).fail(function(reponse){
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('.loading-screen').removeClass('show')

    $('#chupy-msg').addClass('show')
  })
}


// Form Behaviour

let isFormNamaValid
let isFormGenderValid
let isFormTempatValid
let isFormTanggalValid
let isFormTeleponValid
let isFormEmailValid
let isFormAlamatValid
let isFormPasswordValid
let isFormPasswordSame
let isAggrementChecked

$('#form-nama').on('input', function(){
  let val = $(this).val()
  let regExp = new RegExp('[a-zA-Z ]','g')
  if (val.match(regExp)) {
    $(this).removeClass('is-invalid')
    isFormNamaValid = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormNamaValid = false
  }
  submitButtonBehaviour()
})

$('#form-tempat').on('input', function(){
  let val = $(this).val()
  let regExp = new RegExp('[a-zA-Z ]','g')
  if (val.match(regExp)) {
    $(this).removeClass('is-invalid')
    isFormTempatValid = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormTempatValid = false
  }
  submitButtonBehaviour()
})

$('#form-no-telepon').on('input', function(){
  let val = $(this).val()
  if (Validation(val).phoneValidation()) {
    $(this).removeClass('is-invalid')
    isFormTeleponValid = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormTeleponValid = false
  }
  submitButtonBehaviour()
})

$('#form-email').on('input', function(){
  let val = $(this).val()
  if (Validation(val).emailValidation()) {
    $(this).removeClass('is-invalid')
    isFormEmailValid = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormEmailValid = false
  }
  submitButtonBehaviour()
})

$('#form-tanggal').on('input', function(){
  let val = $(this).val()
  if (val != '') {
    isFormTanggalValid = true
  }
  else{
    isFormTanggalValid = false
  }
  submitButtonBehaviour()
})

$('#form-password').on('input', function(){
  let val = $(this).val()
  if (val != '') {
    isFormPasswordValid = true
  }
  else{
    isFormPasswordValid = false
  }
  submitButtonBehaviour()
})

$('#form-re-password').on('input', function(){
  let val = $(this).val()
  if (val == $('#form-password').val()) {
    $(this).removeClass('is-invalid')
    isFormPasswordSame = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormPasswordSame = false
  }
  submitButtonBehaviour()
})

$('#form-aggrement').on('click', function(){
  let isChecked = $(this).is(':checked')
  if (isChecked) {
    isAggrementChecked = true
  }
  else{
    isAggrementChecked = false
  }
  submitButtonBehaviour()
})

$('input[name="gender"]').on('input', function(){
  let val = $(this).val()
  if (val != '') {
    isFormGenderValid = true
  }
  else{
    isFormGenderValid = false
  }
  submitButtonBehaviour()
})

$('#form-alamat').on('input', function(){
  let val = $(this).val()
  if (val != '') {
    isFormAlamatValid = true
  }
  else{
    isFormAlamatValid = false
  }
  submitButtonBehaviour()
})
function submitButtonBehaviour(){
  let submitButton = $('input[type="submit"]')
  if (isAggrementChecked && isFormNamaValid && isFormEmailValid && isFormAlamatValid && isFormPasswordSame && isFormTeleponValid && isFormPasswordValid && isFormTempatValid && isFormGenderValid && isFormTanggalValid ) {
    submitButton.prop('disabled', false)
  }
  else{
    submitButton.prop('disabled', true)
  }
}
