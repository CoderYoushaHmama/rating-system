var open_sidebar_btn = document.getElementById('open-sidebar-btn');
var close_sidebar_btn = document.getElementById('close-sidebar-btn');
var sidebar = document.getElementById('sidebar');

open_sidebar_btn.addEventListener('click', ()=>{
     sidebar.style.display = 'block';
     sidebar.style.animationName = 'open-sidebar';
});

close_sidebar_btn.addEventListener('click', ()=>{
     sidebar.style.animationName = 'close-sidebar';
     setTimeout(function (){
          sidebar.style.display = 'none';
     },300);
});