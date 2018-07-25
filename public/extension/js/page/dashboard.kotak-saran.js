let kotakSaranData = []

$(document).ready(function(){
  // Kategori Produk Data List
  $.ajax({
    url: '/api/kotak_saran',
    method: 'GET',
    dataType: 'json'
  }).done(function(response) {
    let dataSet = []
    kotakSaranData = response.data
    for (let item of response.data) {
       pesan = {
        id: item.id,
        email: item.email,
        pesan: item.isiPesan,
        tanggal: item.createdAt,
        aksi: '<button data-toggle="modal" data-target="#hapus-modal-pesan" class="btn btn-danger my-1 mr-1" data-pesan-id="' + item.id + '">Hapus</button> '
      }

      dataSet.push(pesan)
    }

    result = {
      'data': dataSet
    }
    $('#table-jenis-list').DataTable({
      data: result.data,
      columns: [
        {data: "email"},
        {data: "pesan"},
        {data: "tanggal"},
        {data: "aksi"}
      ]
    })
  })
  }
)



$('#hapus-modal-pesan').on('show.bs.modal', function(event) {
  let button = $(event.relatedTarget)
  let pesanId = button.data('pesan-id')
  let modal = $(this)

  let data = kotakSaranData.find(function(item) {
    return item.id == pesanId
  })

  console.log(data);

  modal.find('#hapus-modal-nama-pengirim').text(data.email)
  modal.find('#hapus-modal-tanggal-kirim').text(data.createdAt)
  modal.find('#hapus-modal-confirm').attr('data-id', data.id)
})

function deletePesan(target) {
  let element = $(target)

  $.ajax({
    url: '/api/kotak_saran/hapus',
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
    $('#chupy-msg').find('strong + span').text('Pesan berhasil dihapus.')
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
