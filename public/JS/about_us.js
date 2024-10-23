var star1 = document.getElementById('s1');
var star2 = document.getElementById('s2');
var star3 = document.getElementById('s3');
var star4 = document.getElementById('s4');
var star5 = document.getElementById('s5');

window.addEventListener('load', () => {
     setTimeout(() => {
          star1.style.opacity = '1';
     }, 0);
     setTimeout(() => {
          star2.style.opacity = '1';
     }, 500);
     setTimeout(() => {
          star3.style.opacity = '1';
     }, 1000);
     setTimeout(() => {
          star4.style.opacity = '1';
     }, 1500);
     setTimeout(() => {
          star5.style.opacity = '1';
     }, 2000);
});
