let asideMenus = $('#side-wrapper ul')
switch (window.location.pathname) {
  case '/admin/dashboard/user':
    asideMenus.find('li:nth-child(2) a').addClass('active')
    break;
  case '/admin/dashboard/produk':
    asideMenus.find('li:nth-child(3) a').addClass('active')
    break;
  case '/admin/dashboard/kategori':
    asideMenus.find('li:nth-child(4) a').addClass('active')
    break;
  case '/admin/dashboard/jenis':
    asideMenus.find('li:nth-child(5) a').addClass('active')
    break;
  case '/admin/dashboard/kotak_saran':
    asideMenus.find('li:nth-child(6) a').addClass('active')
    break;
  default:
    asideMenus.find('li:first-child a').addClass('active')
}
