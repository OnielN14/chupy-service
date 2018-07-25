let produkData = []
let jenisProdukData = []
let kategoriProdukData = []

$(document).ready(function(){
  // Produk Data List
  $.ajax({
    url: '/api/produk',
    method: 'GET',
    dataType: 'json'
  }).done(function(response) {
    let dataSet = []
    produkData = response.data
    for (let item of response.data) {
      produk = {
        nama: item.nama,
        deskripsi: item.deskripsi,
        jenis: item.jenis,
        kategori: item.kategori,
        stok: item.stok,
        harga: item.harga,
        aksi: '<button class="btn btn-success my-1 mr-1" data-toggle="modal" data-target="#edit-modal-produk" data-produk-id="' + item.id + '">Ubah</button><button data-toggle="modal" data-target="#hapus-modal-produk" class="btn btn-danger my-1 mr-1" data-produk-id="' + item.id + '">Hapus</button> '
      }

      dataSet.push(produk)
    }

    result = {
      'data': dataSet
    }
    $('#table-produk-list').DataTable({
      data: result.data,
      columns: [
        {data: "nama"},
        {data: "deskripsi"},
        {data: "jenis"},
        {data: "kategori"},
        {data: "stok"},
        {data: "harga"},
        {data: "aksi"}
      ]
    })
  })
  }
)

  // Jenis Produk
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

  // Kategori Produk
$.ajax({
    url: '/api/kategori_produk',
    method: 'get',
    dataType: 'json'
  }).done(function(response) {
    kategoriProdukData = response.data
  })

$('#form-jenis').on('change', function(){
  let idJenis = $(this).val()
  let defaultOption = document.createElement('option')
  defaultOption.setAttribute('disabled', true)
  defaultOption.setAttribute('selected', true)
  defaultOption.innerHTML = "Pilih Kategori Produk"

  $('#form-kategori').empty()
  $('#form-kategori').append($(defaultOption).clone())

  let data = kategoriProdukData.filter(function(item){
    return item.idJenis == idJenis
  })

  elements = []
  for (let item of data) {
    let option = document.createElement('option')
    option.setAttribute('value',item.id)
    option.innerHTML = item.nama

    elements.push(option)
  }

  let jElements = $(elements)
  $('#form-kategori').prop('disabled',false)
  $('#form-kategori').append(jElements.clone())

})


$('#form-edit-jenis').on('change', function(){
  let idJenis = $(this).val()
  let defaultOption = document.createElement('option')
  defaultOption.setAttribute('disabled', true)
  defaultOption.setAttribute('selected', true)
  defaultOption.innerHTML = "Pilih Kategori Produk"

  $('#form-edit-kategori').empty()
  $('#form-edit-kategori').append($(defaultOption).clone())

  let data = kategoriProdukData.filter(function(item){
    return item.idJenis == idJenis
  })

  console.log(kategoriProdukData);
  elements = []
  for (let item of data) {
    let option = document.createElement('option')
    option.setAttribute('value',item.id)
    option.innerHTML = item.nama

    elements.push(option)
  }

  let jElements = $(elements)
  $('#form-edit-kategori').prop('disabled',false)
  $('#form-edit-kategori').append(jElements.clone())

})


// disable normal form behaviour
$('form#form-produk-new').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-produk-new').submit(function(e) {
  tambahProduk();
  return false
})


// disable normal form behaviour
$('form#form-produk-edit').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$('form#form-produk-edit').submit(function(e) {
  ubahProduk()
  return false
})


$('#hapus-modal-produk').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let produkId = button.data('produk-id')
  let modal = $(this)

  let data = produkData.find(function(item) {
    return item.id == produkId
  })

  modal.find('#hapus-modal-nama-produk').text(data.nama)
  modal.find('#hapus-modal-confirm').attr('data-id', data.id)
})

$('#edit-modal-produk').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let produkId = button.data('produk-id')
  let modal = $(this)

  let data = produkData.find(function(item) {
    return item.id == produkId
  })

  modal.find('form #form-edit-id').val(data.id)
  modal.find('form #form-edit-nama').val(data.nama)
  modal.find('form #form-edit-stok').val(data.stok)
  modal.find('form #form-edit-harga').val(data.harga)
  modal.find('form #form-edit-deskripsi').val(data.deskripsi)
  modal.find('form #form-edit-jenis').val(data.idJenis)

  let defaultOption = document.createElement('option')
  defaultOption.setAttribute('disabled', true)
  defaultOption.setAttribute('selected', true)
  defaultOption.innerHTML = "Pilih Kategori Produk"

  $('#form-edit-kategori').empty()
  $('#form-edit-kategori').append($(defaultOption).clone())

  let kategoriProduk = kategoriProdukData.filter(function(item){
    return item.idJenis == data.idJenis
  })

  elements = []
  for (let item of kategoriProduk) {
    let option = document.createElement('option')
    option.setAttribute('value',item.id)
    option.innerHTML = item.nama

    elements.push(option)
  }

  let jElements = $(elements)
  $('#form-edit-kategori').prop('disabled',false)
  $('#form-edit-kategori').append(jElements.clone())


  modal.find('form #form-edit-kategori').val(data.idKategori)
})


function deleteProduk(target) {
  let element = $(target)

  $.ajax({
    url: '/api/produk/hapus',
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
    $('#chupy-msg').find('strong + span').text('Produk berhasil dihapus.')
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

function ubahProduk() {
  let form = document.querySelector('form#form-produk-edit')

  let data = new FormData(form)
  data.append('id', $('#form-edit-id').val())

  $('#edit-modal-produk').modal('toggle')
  $.ajax({
    url: '/api/produk/ubah',
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
    $('#chupy-msg').find('strong + span').text('Produk berhasil diubah.')
    $('#chupy-msg').addClass('show')
    // setTimeout(function() {
    //   location.reload();
    // }, 1000)
  }).fail(function(response) {
    $('#chupy-msg').addClass('alert-danger')

    $('#chupy-msg').find('strong').text('Gagal')
    $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')

    $('#chupy-msg').addClass('show')
  })
}


function tambahProduk() {
  let form = document.querySelector('form#form-produk-new')
  let data = new FormData(form)

  $('#input-modal-produk').modal('toggle')
  $.ajax({
    url: '/api/produk/tambah',
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
    $('#chupy-msg').find('strong + span').text('Produk berhasil ditambahkan.')
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
