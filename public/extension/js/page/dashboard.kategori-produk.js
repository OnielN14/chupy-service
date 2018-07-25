let kategoriProdukData = []
let jenisProdukData = []

$(document).ready(function(){
  // Kategori Produk Data List
  $.ajax({
    url: '/api/kategori_produk',
    method: 'GET',
    dataType: 'json'
  }).done(function(response) {
    let dataSet = []
    kategoriProdukData = response.data
    for (let item of response.data) {
       kategori = {
        id: item.id,
        nama: item.nama,
        jenis: item.namaJenis,
        aksi: '<button class="btn btn-success my-1 mr-1" data-toggle="modal" data-target="#edit-modal-kategori" data-kategori-id="' + item.id + '">Ubah</button><button data-toggle="modal" data-target="#hapus-modal-kategori" class="btn btn-danger my-1 mr-1" data-kategori-id="' + item.id + '">Hapus</button> '
      }

      dataSet.push(kategori)
    }

    result = {
      'data': dataSet
    }
    $('#table-produk-list').DataTable({
      data: result.data,
      columns: [
        {data: "id"},
        {data: "nama"},
        {data: "jenis"},
        {data: "aksi"}
      ]
    })
  })
  }
)

  // Kategori Produk
$.ajax({
    url: '/api/jenis_produk',
    method: 'get',
    dataType: 'json'
  }).done(function(response) {

    jenisProdukData = response.data

    let elements = []
    let option = document.createElement('option')
    for (let item of response.data) {
      let option = document.createElement('option')
      option.setAttribute('value', item.id)
      option.innerHTML = item.nama

      elements.push(option)
    }

    let jElements = $(elements)
    $('select#form-jenis').append(jElements.clone())
    $('select#form-edit-jenis').append(jElements.clone())
  })
//
//
// $('#form-jenis').on('change', function(){
//   let idJenis = $(this).val()
//   let defaultOption = document.createElement('option')
//   defaultOption.setAttribute('disabled', true)
//   defaultOption.setAttribute('selected', true)
//   defaultOption.innerHTML = "Pilih Kategori Produk"
//
//   $('#form-kategori').empty()
//   $('#form-kategori').append($(defaultOption).clone())
//
//   let data = kategoriProdukData.filter(function(item){
//     return item.idJenis == idJenis
//   })
//
//   elements = []
//   for (let item of data) {
//     let option = document.createElement('option')
//     option.setAttribute('value',item.id)
//     option.innerHTML = item.nama
//
//     elements.push(option)
//   }
//
//   let jElements = $(elements)
//   $('#form-kategori').prop('disabled',false)
//   $('#form-kategori').append(jElements.clone())
//
// })
//
//
// $('#form-edit-jenis').on('change', function(){
//   let idJenis = $(this).val()
//   let defaultOption = document.createElement('option')
//   defaultOption.setAttribute('disabled', true)
//   defaultOption.setAttribute('selected', true)
//   defaultOption.innerHTML = "Pilih Kategori Produk"
//
//   $('#form-edit-kategori').empty()
//   $('#form-edit-kategori').append($(defaultOption).clone())
//
//   let data = kategoriProdukData.filter(function(item){
//     return item.idJenis == idJenis
//   })
//
//   console.log(kategoriProdukData);
//   elements = []
//   for (let item of data) {
//     let option = document.createElement('option')
//     option.setAttribute('value',item.id)
//     option.innerHTML = item.nama
//
//     elements.push(option)
//   }
//
//   let jElements = $(elements)
//   $('#form-edit-kategori').prop('disabled',false)
//   $('#form-edit-kategori').append(jElements.clone())
//
// })
//
//
// disable normal form behaviour
$('form#form-kategori-new').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-kategori-new').submit(function(e) {
  tambahKategoriProduk()
  return false
})


// disable normal form behaviour
$('form#form-kategori-edit').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-kategori-edit').submit(function(e) {
  ubahKategoriProduk()
  return false
})


$('#hapus-modal-kategori').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let kategoriId = button.data('kategori-id')
  let modal = $(this)

  let data = kategoriProdukData.find(function(item) {
    return item.id == kategoriId
  })

  modal.find('#hapus-modal-nama-produk').text(data.nama)
  modal.find('#hapus-modal-confirm').attr('data-id', data.id)
})

$('#edit-modal-kategori').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let kategoriId = button.data('kategori-id')
  let modal = $(this)

  let data = kategoriProdukData.find(function(item) {
    return item.id == kategoriId
  })

  modal.find('form #form-edit-id').val(data.id)
  modal.find('form #form-edit-nama').val(data.nama)
  modal.find('form #form-edit-jenis').val(data.idJenis)

  modal.find('form #form-edit-kategori').val(data.idKategori)
})


function deleteKategoriProduk(target) {
  let element = $(target)

  $.ajax({
    url: '/api/kategori_produk/hapus',
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
    $('#chupy-msg').find('strong + span').text('Kategori produk berhasil dihapus.')
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

function ubahKategoriProduk() {
  let form = document.querySelector('form#form-kategori-edit')

  let data = new FormData(form)
  data.append('id', $('#form-edit-id').val())

  $('#edit-modal-kategori').modal('toggle')
  $.ajax({
    url: '/api/kategori_produk/ubah',
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
    $('#chupy-msg').find('strong + span').text('Kategori produk berhasil diubah.')
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


function tambahKategoriProduk() {
  let form = document.querySelector('form#form-kategori-new')
  let data = new FormData(form)

  $('#input-modal-kategori').modal('toggle')
  $.ajax({
    url: '/api/kategori_produk/tambah',
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
    $('#chupy-msg').find('strong + span').text('Kategori produk berhasil ditambahkan.')
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
