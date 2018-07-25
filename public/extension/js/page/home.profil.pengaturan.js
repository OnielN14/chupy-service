// disable normal form behaviour
$('form#form-profil').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-profil').submit(function(e) {
  updateProfil();
  return false
})

$('form#form-edit-password').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-edit-password').submit(function(e) {
  updatePassword();
  return false
})

function updateProfil(){
  let form = document.querySelector('form#form-profil')
  let formData = new FormData(form)

  formData.append('email', $('#form-email').val())

  $.ajax({
    url:'/api/pengguna/profil/ubah',
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
  }).done(function(response){

    // console.log(response);
    $('#chupy-msg').addClass('alert-success')

    $('#chupy-msg').find('strong').text('Sukses')
    $('#chupy-msg').find('strong + span').text('Profil berhasil diubah.')
    $('#chupy-msg').addClass('show')
    setTimeout(function() {
      window.location.reload()
    }, 1000)

  }).fail(function(reponse){
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('.loading-screen').removeClass('show')

    $('#chupy-msg').addClass('show')
  })
}

function updatePassword() {
  let form = document.querySelector('form#form-edit-password')
  let formData = new FormData(form)

  $.ajax({
    url:'/api/pengguna/profil/ubah/password',
    method :'POST',
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

      document.querySelector('#chupy-edit-password-container').scrollIntoView({
        behavior: 'smooth'
      })
    }
  }).done(function(response){
    switch (response.status) {
      case 200:
          $('#chupy-msg').addClass('alert-success')
          $('#chupy-msg').find('strong').text('Sukses')
          $('#chupy-msg').find('strong + span').text('Password berhasil diubah.')

          setTimeout(function() {
            window.location.reload()
          }, 1000)
        break;
      case 201:
          $('#chupy-msg').addClass('alert-danger')
          $('#chupy-msg').find('strong').text('Gagal')
          $('#chupy-msg').find('strong + span').text('Password salah.')

      default:

    }

    $('#chupy-msg').addClass('show')

  }).fail(function(reponse){
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('#chupy-msg').addClass('show')
  })
}



// Form Behaviour

let isFormNamaValid = true
let isFormTeleponValid = true
let isFormAlamatValid = true

let isFormPasswordValid = false
let isFormPasswordOldValid = false
let isFormPasswordSame = false

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
  submitUpadatePassword()
})

$('#form-password').on('input', function(){
  let val = $(this).val()
  if (val != '') {
    $(this).removeClass('is-invalid')
    isFormPasswordValid = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormPasswordValid = false
  }
  submitUpadatePassword()
})

$('#form-old-password').on('input', function(){
  let val = $(this).val()
  if (val != '') {
    $(this).removeClass('is-invalid')
    isFormPasswordOldValid = true
  }
  else{
    $(this).addClass('is-invalid')
    isFormPasswordOldValid = false
  }
  submitUpadatePassword()
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

function submitUpadatePassword(){
  let submitButton = $('input#btn-ganti-password')
  if (isFormPasswordOldValid && isFormPasswordValid && isFormPasswordSame) {
    submitButton.prop('disabled', false)
  }
  else{
    submitButton.prop('disabled', true)
  }
}


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#gambarProfile').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#ubah-foto").change(function() {
  readURL(this);
});
