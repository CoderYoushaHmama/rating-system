var notifications = document.querySelectorAll('.notification');
var background = document.getElementById('background');
var delete_comment_section = document.querySelectorAll('.delete-comment-section');
var cancel_btn = document.querySelectorAll('.cancel-btn');
var close_btn = document.querySelectorAll('.close-btn');

for(let i = 0; i < notifications.length; i++){
     notifications[i].addEventListener('click', ()=>{
          delete_comment_section[i].style.display = 'block';
          background.style.display = 'block';
     });

     close_btn[i].addEventListener('click', ()=>{
          delete_comment_section[i].style.display = 'none';
          background.style.display = 'none';
     });
}