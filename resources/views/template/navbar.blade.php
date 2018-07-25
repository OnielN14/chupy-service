<nav class="chupy-navbar navbar fixed-top navbar-expand-lg navbar-light">
  <a href="/" class="navbar-brand">
    <img src="/extension/img/chupy_icon-light.png" alt="Chupy Brand">
  </a>

  <button id="navbarToggle" class="navbar-toggler chupy-navbar" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="chupy-navbar nav justify-content-end collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/">Beranda</a>
    </li>
    <li class="nav-item">
      <div class="dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="produk-menu-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produk</a>

          <div class="chupy-dropdown dropdown-menu" aria-labelledby="produk-menu-link">
            <a class="dropdown-item" href="/produk/hewan">Hewan Peliharaan</a>
            <a class="dropdown-item" href="/produk/kebutuhan">Kebutuhan Hewan Peliharaan</a>
          </div>
      </div>


    </li>
    <li class="nav-item">
      <a class="nav-link" href="/tentang">Tentang Kami</a>
    </li>
  <?php
    if (isset($_SESSION['login_user'])) {
  ?>
  <li class="nav-item">

    <div class="dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button"  data-toggle="dropdown"><?php echo $_SESSION['login_user']['nama'] ?></a>

        <div class="chupy-dropdown dropdown-menu" aria-labelledby="produk-menu-link" style="right:0px;left:auto;">
  <?php
    if ($_SESSION['login_user']['idHakAkses'] == 1) {
  ?>
      <a class="dropdown-item" href="/admin/dashboard">Dashboard</a>

  <?php
    }
  ?>
          <a class="dropdown-item" href="/profile">Profile</a>
          <a class="dropdown-item" href="/profile/keranjang">Keranjang</a>
          <a class="dropdown-item" href="/profile/wishlist">WishList</a>
          <a class="dropdown-item" href="/logout">Logout</a>
        </div>
    </div>

  </li>
  <?php
    }
    else{
  ?>
      <li class="nav-item">
        <a class="nav-link" href="/login">Masuk/Daftar</a>
      </li>
  <?php
    }
  ?>
  </ul>
</div>
</nav>
