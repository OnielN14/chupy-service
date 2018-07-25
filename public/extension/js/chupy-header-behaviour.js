$('#navbarToggle').on('click', function(){
  let toggleTarget = $('#navbarNav');
  if (toggleTarget.hasClass('show')) {
    $('body').css({'overflow':'visible'})
  }else{
    $('body').css({'overflow':'hidden'})
  }
})

// navbar behavior
let navBarMenus = $('ul.navbar-nav')
console.log(window.location.pathname);
switch (window.location.pathname.split('/')[1]) {
  case 'produk':
    navBarMenus.find('li:nth-child(2)').addClass('active')
    break;
  case 'produk':
    navBarMenus.find('li:nth-child(2)').addClass('active')
    break;
  case 'tentang':
    navBarMenus.find('li:nth-child(3)').addClass('active')
    break;
  case 'profile':
    navBarMenus.find('li:nth-child(4)').addClass('active')
    break;
  default:
    navBarMenus.find('li:first-child').addClass('active')
}
