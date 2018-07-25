// document.querySelector('.chupy-message').style.zIndex = -1

let button = document.querySelectorAll('.chupy-message button[data-close]')

button.forEach(function(item){
  item.addEventListener("click", chupyMessageClose)
})

function chupyMessageClose(){
  let target = this.getAttribute('data-close')
  let targetElement = document.querySelector('#'+target)
  targetElement.classList.toggle('show', false)
  setTimeout(function(){
    targetElement.classList.toggle('hide',true)
  }, 500)
}
