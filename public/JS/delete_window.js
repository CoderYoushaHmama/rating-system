var delete_sections = document.querySelectorAll('.delete-confirmation-section');
var cancel_btns = document.querySelectorAll('.cancel-btn');
var delete_btns = document.querySelectorAll('.delete-btns');
var background = document.getElementById('background');

for (let i = 0 ; i<delete_btns.length ; i++){
     delete_btns[i].addEventListener('click', ()=>{
          delete_sections[i].style.display = 'block';
          background.style.display = 'block';
     });

     cancel_btns[i].addEventListener('click', ()=>{
          delete_sections[i].style.display = 'none';
          background.style.display = 'none';
     })
}