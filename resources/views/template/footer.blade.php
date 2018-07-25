<footer class="chupy-footer">
  <section class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-xs-12">

        <div class="row">
          <div class="col">
            <a href="/" class="chupy-footer-brand">
              <img class="chupy-footer-img" src="/extension/img/chupy_icon-dark.png" alt="">
              <p>Pet Paradise</p>
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col chupy-footer-description">
            <h2>Alamat</h2>
            <p>Jalan Dipatiukur No. 112-116, Coblong, Lebakgede, Bandung Jawa Barat 40132</p>
          </div>
        </div>

        <div class="row">
          <div class="col chupy-footer-description">
            <h2>Kontak</h2>
            <p><span>Telepon</span> <span>+62 8XX XXXX XXXX</span></p>
            <p><span>Email</span> <span>chopchop@chupy.com</span></p>
          </div>
        </div>

      </div>
      <div class="col-md-6 col-xs-12 chupy-footer-description">
        <h2>Saran</h2>
        <form style="position:relative">
          <input type="hidden" name="front_end_key" value="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-8">
                  <input class="form-control" type="email" name="email" value="" placeholder="E-mail">
              </div>
              <div class="col-4">
                  <input type="submit" value="Kirim"  class="form-control btn btn-light">
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea name="pesan" rows="3" id="form-saran-pesan" class="form-control" placeholder="Ketikkan saran " required></textarea>
          </div>
          <div class="chupy-message cover-message hide" id="kotak-saran-message">
            <div class="chupy-message-body">
              <p class="chupy-message-loading-text">Mohon tunggu ...</p>
              <p class="chupy-message-error-text">Terjadi kesalahan </br> <button type="button" data-close="kotak-saran-message" class="btn btn-primary">Tutup</button></p>
              <p class="chupy-message-text">Pesan Sudah Dikirim </br> <button type="button" data-close="kotak-saran-message" class="btn btn-primary">Tutup</button></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <section class="text-center">
    <p>Hak Cipta &copy; <?php echo date('Y') ?></p>
  </section>
</footer>

<script src="/extension/plugins/jquery-3.3.1/jquery-3.3.1.js"></script>
<script src="/extension/plugins/popper-js-1.14.3/popper-1.14.3.js"></script>
<script src="/extension/plugins/bootstrap-4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/extension/js/chupy-header-behaviour.js">
</script>
<script type="text/javascript" src="/extension/js/chupy-message-behaviour.js">
</script>
<script type="text/javascript" src="/extension/js/chupy-scrolling-behaviour.js">
</script>
<script type="text/javascript" src="/extension/js/chupy-alert-behaviour.js">
</script>


<script type="text/javascript" src="/extension/js/page/footer.kotak-saran.js">
</script>
