var menu_btn = document.getElementById('menu-btn');
var menu = document.getElementById('menu');

var open = false;

menu_btn.addEventListener('click', ()=>{
     if(open){
          menu.style.display = 'none';
          open = false;
     }else{
          menu.style.display = 'block';
          open = true;
     }
});