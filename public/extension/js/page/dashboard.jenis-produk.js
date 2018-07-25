let jenisProdukData = []

$(document).ready(function(){
  // Kategori Produk Data List
  $.ajax({
    url: '/api/jenis_produk',
    method: 'GET',
    dataType: 'json'
  }).done(function(response) {
    let dataSet = []
    jenisProdukData = response.data
    for (let item of response.data) {
       jenis = {
        id: item.id,
        nama: item.nama,
        aksi: '<button class="btn btn-success my-1 mr-1" data-toggle="modal" data-target="#edit-modal-jenis" data-jenis-id="' + item.id + '">Ubah</button><button data-toggle="modal" data-target="#hapus-modal-jenis" class="btn btn-danger my-1 mr-1" data-jenis-id="' + item.id + '">Hapus</button> '
      }

      dataSet.push(jenis)
    }

    result = {
      'data': dataSet
    }
    $('#table-jenis-list').DataTable({
      data: result.data,
      columns: [
        {data: "id"},
        {data: "nama"},
        {data: "aksi"}
      ]
    })
  })
  }
)

// disable normal form behaviour
$('form#form-jenis-new').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-jenis-new').submit(function(e) {
  tambahJenisProduk()
  return false
})


// disable normal form behaviour
$('form#form-jenis-edit').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-jenis-edit').submit(function(e) {
  ubahJenisProduk()
  return false
})


$('#hapus-modal-jenis').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let jenisiId = button.data('jenis-id')
  let modal = $(this)

  let data = jenisProdukData.find(function(item) {
    return item.id == jenisiId
  })

  modal.find('#hapus-modal-nama-jenis').text(data.nama)
  modal.find('#hapus-modal-confirm').attr('data-id', data.id)
})

$('#edit-modal-jenis').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let jenisiId = button.data('jenis-id')
  let modal = $(this)

  let data = jenisProdukData.find(function(item) {
    return item.id == jenisiId
  })

  modal.find('form #form-edit-id').val(data.id)
  modal.find('form #form-edit-nama').val(data.nama)
})


function deleteJenisProduk(target) {
  let element = $(target)

  $.ajax({
    url: '/api/jenis_produk/hapus',
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
    $('#chupy-msg').find('strong + span').text('Jenis produk berhasil dihapus.')
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

function ubahJenisProduk() {
  let form = document.querySelector('form#form-jenis-edit')

  let data = new FormData(form)
  data.append('id', $('#form-edit-id').val())

  $('#edit-modal-kategori').modal('toggle')
  $.ajax({
    url: '/api/jenis_produk/ubah',
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
    $('#chupy-msg').find('strong + span').text('Jenis produk berhasil diubah.')
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


function tambahJenisProduk() {
  let form = document.querySelector('form#form-jenis-new')
  let data = new FormData(form)

  $('#input-modal-jenis').modal('toggle')
  $.ajax({
    url: '/api/jenis_produk/tambah',
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
    $('#chupy-msg').find('strong + span').text('Jenis produk berhasil ditambahkan.')
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
