var open_service_provider_section = document.getElementById('open-service-provider-section');
var open_rating_section = document.getElementById('open-rating-section');
var close_service_provider_section = document.getElementById('close-service-provider-section');
var close_rating_section = document.getElementById('close-rating-section');
var service_provider_section = document.getElementById('service-provider-section');
var rating_section = document.getElementById('rating-section');
var background = document.getElementById('background');
var stars = document.querySelectorAll('.stars-rates');
var inputs = document.querySelectorAll('.inputs-rates');
var rating_btn = document.getElementById('rating-btn');
var comment = document.getElementById('comments');

open_service_provider_section.addEventListener('click', () => {
     service_provider_section.style.animationName = 'open-service-provide-details';
     background.style.display = 'block';
     service_provider_section.style.display = 'block';
});

close_service_provider_section.addEventListener('click', () => {
     background.style.display = 'none';
     service_provider_section.style.animationName = 'close-service-provide-details';
     setTimeout(function () {
          service_provider_section.style.display = 'none';
     }, 300);
});

open_rating_section.addEventListener('click', () => {
     rating_section.style.animationName = 'open-rating';
     background.style.display = 'block';
     rating_section.style.display = 'block';
});

close_rating_section.addEventListener('click', () => {
     background.style.display = 'none';
     rating_section.style.animationName = 'close-rating';
     setTimeout(function () {
          rating_section.style.display = 'none';
     }, 300);
});

for (let i = 0; i < stars.length; i++) {
     stars[i].addEventListener('click', () => {
          var count = i;
          for (let j = 0; j < stars.length; j++) {
               inputs[j].removeAttribute('checked');
               stars[j].setAttribute('src', url+'/SVG/star.svg');
          }
          inputs[i].setAttribute('checked', true);
          while (count >= 0) {
               stars[count].setAttribute('src', url+'/SVG/fill-star.svg');
               count--;
          }

          if(comment.value){
               rating_btn.removeAttribute('disabled');
          }else{
               rating_btn.setAttribute('disabled', true);
          }
     });
}

comment.addEventListener('input', () => {
     var count = 0;
     for (let i = 0; i < stars.length; i++) {
          if (!inputs[i].getAttribute('checked')) {
               count++;
          }
     }

     if(count != stars.length && comment.value){
          rating_btn.removeAttribute('disabled');
     }else{
          rating_btn.setAttribute('disabled', true);
     }
});