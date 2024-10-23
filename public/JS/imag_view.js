var main_image = document.getElementById('main_image');
var images = document.querySelectorAll('.images');

var move_count = 0;

images.forEach(image => {
     image.addEventListener('click', ()=>{
          main_image.style.display = 'none';
          main_image.setAttribute('src',image.getAttribute('src'));
          setTimeout(function (){
               main_image.style.display = 'block';
          },0.1);
     });
});

setInterval(function (){
     main_image.style.display = 'none';
     main_image.setAttribute('src',images[move_count].getAttribute('src'));
     setTimeout(function (){
          main_image.style.display = 'block';
     },0.1);
     move_count++;
     if(move_count >= images.length){
          move_count = 0;
     }
},5000);