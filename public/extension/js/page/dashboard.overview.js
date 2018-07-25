$.ajax({
  url:'/api/produk',
  method:'get',
  dataType:'json'
}).done(function(response){
  $('#data-produk').find('.data-count-indicator').html(response.count)
})

$.ajax({
  url:'/api/pengguna',
  method:'get',
  dataType:'json'
}).done(function(response){
  $('#data-user').find('.data-count-indicator').html(response.count)
})

$.ajax({
  url:'/api/kategori_produk',
  method:'get',
  dataType:'json'
}).done(function(response){
  $('#data-kategori').find('.data-count-indicator').html(response.count)
})

$.ajax({
  url:'/api/jenis_produk',
  method:'get',
  dataType:'json'
}).done(function(response){
  $('#data-jenis').find('.data-count-indicator').html(response.count)
})

$.ajax({
  url:'/api/kotak_saran',
  method:'get',
  dataType:'json'
}).done(function(response){
  $('#data-pesan').find('.data-count-indicator').html(response.count)
})
