let userData = []


$(document).ready(function() {
  // User Data List
  $.ajax({
    url: '/api/pengguna',
    method: 'GET',
    dataType: 'json'
  }).done(function(response) {
    let dataSet = []
    userData = response.data
    for (let index in response.data) {
      user = {
        nama: response.data[index].nama,
        alamat: response.data[index].alamat,
        email: response.data[index].email,
        noTelepon: response.data[index].noTelepon,
        aksi: '<button class="btn btn-success my-1 mr-1" data-toggle="modal" data-target="#edit-modal" data-user-id="' + response.data[index].id + '">Ubah</button><button data-toggle="modal" data-target="#hapus-modal" class="btn btn-danger my-1 mr-1" data-user-id="' + response.data[index].id + '">Hapus</button> '
      }

      dataSet.push(user)
    }

    result = {
      'data': dataSet
    }
    // console.log(result);
    $('#table-user-list').DataTable({
      data: result.data,
      columns: [{
          data: "nama"
        },
        {
          data: "alamat"
        },
        {
          data: "email"
        },
        {
          data: "noTelepon"
        },
        {
          data: "aksi"
        }
      ]
    })
  })

  // Jenis Produk
  $.ajax({
    url: '/api/hak_akses',
    method: 'get',
    dataType: 'json'
  }).done(function(response) {
    let elements = []
    let option = document.createElement('option')
    for (let index in response.data) {
      let option = document.createElement('option')
      option.setAttribute('value', response.data[index].id)
      option.innerHTML = response.data[index].levelAkses

      elements.push(option)
    }

    let jElements = $(elements)
    $('select#form-hak-akses').append(jElements.clone())
    $('select#form-edit-hak-akses').append(jElements.clone())
  })

})

// disable normal form behaviour
$('form#form-user-new').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    // tambahUser();
    return false;
  }
});

$('form#form-user-new').submit(function(e) {
  tambahUser();
  return false
})


// disable normal form behaviour
$('form#form-user-edit').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    // ubahUser()
    return false;
  }
});

$('form#form-user-edit').submit(function(e) {
  ubahUser()
  return false
})


$('#hapus-modal').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let userId = button.data('user-id')
  let modal = $(this)

  let data = userData.find(function(item) {
    return item.id == userId
  })

  modal.find('#hapus-modal-nama-pengguna').text(data.nama)
  modal.find('#hapus-modal-confirm').attr('data-id', data.id)
})

$('#edit-modal').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let userId = button.data('user-id')
  let modal = $(this)

  let data = userData.find(function(item) {
    return item.id == userId
  })

  modal.find('form #form-edit-nama').val(data.nama)
  if (data.gender == 'pria') {
    modal.find('form #gender-edit-laki').prop('checked', true)
  } else {
    modal.find('form #gender-edit-perempuan').prop('checked', true)
  }
  modal.find('form #form-edit-no-telepon').val(data.noTelepon)
  modal.find('form #form-edit-email').val(data.email)
  modal.find('form #form-edit-tempat').val(data.tempatLahir)
  modal.find('form #form-edit-tanggal').val(data.tanggalLahir)
  modal.find('form #form-edit-alamat').val(data.alamat)
  modal.find('form #form-edit-hak-akses').val(data.idHakAkses)
})


function deleteUser(target) {
  let element = $(target)

  $.ajax({
    url: '/api/pengguna/hapus',
    method: 'post',
    dataType: 'json',
    data: {
      'id': element.data('id')
    },
    beforeSend: function(response) {
      $('#chupy-msg').removeClass('show')
      $('#chupy-msg').removeClass('alert-warning')
      $('#chupy-msg').removeClass('alert-primary')
      $('#chupy-msg').removeClass('alert-danger')
      $('#chupy-msg').removeClass('alert-success')

      $('#chupy-msg').find('strong').text('Harap tunggu')
      $('#chupy-msg').find('strong + span').text('Permintaan sedang diproses..')

      $('#chupy-msg').addClass('alert-primary')
      $('#chupy-msg').addClass('show')
    }
  }).done(function(response) {
    $('#chupy-msg').addClass('alert-success')

    $('#chupy-msg').find('strong').text('Sukses')
    $('#chupy-msg').find('strong + span').text('Pengguna berhasil dihapus.')
    $('#chupy-msg').addClass('show')
    setTimeout(function() {
      location.reload();
    }, 1000)

  }).fail(function(response) {
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('#chupy-msg').addClass('show')
  })
}

function ubahUser() {
  let form = document.querySelector('form#form-user-edit')

  let data = new FormData(form)

  data.append('email', $('#edit-modal').find('#form-edit-email').val())

  $('#edit-modal').modal('toggle')
  $.ajax({
    url: '/api/pengguna/ubah',
    method: 'post',
    dataType: 'json',
    contentType: false,
    processData: false,
    data: data,
    beforeSend: function(response) {
      $('#chupy-msg').removeClass('show')
      $('#chupy-msg').removeClass('alert-warning')
      $('#chupy-msg').removeClass('alert-primary')
      $('#chupy-msg').removeClass('alert-danger')
      $('#chupy-msg').removeClass('alert-success')

      $('#chupy-msg').find('strong').text('Harap tunggu')
      $('#chupy-msg').find('strong + span').text('Permintaan sedang diproses..')

      $('#chupy-msg').addClass('alert-primary')
      $('#chupy-msg').addClass('show')
    }
  }).done(function(response) {
    $('#chupy-msg').addClass('alert-success')

    $('#chupy-msg').find('strong').text('Sukses')
    $('#chupy-msg').find('strong + span').text('Pengguna berhasil diubah.')
    $('#chupy-msg').addClass('show')
    setTimeout(function() {
      location.reload();
    }, 1000)
  }).fail(function(response) {
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('#chupy-msg').addClass('show')
  })
}

function tambahUser() {
  let form = document.querySelector('form#form-user-new')
  let data = new FormData(form)

  $('#input-modal').modal('toggle')
  $.ajax({
    url: '/api/pengguna/tambah',
    method: 'post',
    dataType: 'json',
    contentType: false,
    processData: false,
    data: data,
    beforeSend: function(response) {
      $('#chupy-msg').removeClass('show')
      $('#chupy-msg').removeClass('alert-warning')
      $('#chupy-msg').removeClass('alert-primary')
      $('#chupy-msg').removeClass('alert-danger')
      $('#chupy-msg').removeClass('alert-success')

      $('#chupy-msg').find('strong').text('Harap tunggu')
      $('#chupy-msg').find('strong + span').text('Permintaan sedang diproses..')

      $('#chupy-msg').addClass('alert-primary')
      $('#chupy-msg').addClass('show')
    }
  }).done(function(response) {
    $('#chupy-msg').addClass('alert-success')

    $('#chupy-msg').find('strong').text('Sukses')
    $('#chupy-msg').find('strong + span').text('Pengguna berhasil ditambahkan.')
    $('#chupy-msg').addClass('show')
    setTimeout(function() {
      location.reload();
    }, 1000)
  }).fail(function(response) {
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('#chupy-msg').addClass('show')
  })
}
