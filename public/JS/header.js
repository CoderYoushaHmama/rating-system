var types = document.querySelectorAll('.type-container');
var search = document.getElementById('search-input');
var search_form = document.getElementById('form-search');
var search_title = document.getElementById('search-title');

for (let i = 0; i < types.length; i++) {
     types[i].addEventListener('click', () => {
          types[i].style.borderBottom = "3px solid black";
          if (i == 0) {
               search.setAttribute('placeholder', 'sections, services');
               search.setAttribute('name', 'all');
               search_title.innerText = 'Search All';
               sessionStorage.setItem('search_type', 'all');
          } else if (i == 1) {
               search.setAttribute('placeholder', 'sections');
               search.setAttribute('name', 'sections');
               search_title.innerText = 'Sections';
               sessionStorage.setItem('search_type', 'sections');
          } else if (i == 2) {
               search.setAttribute('placeholder', 'services');
               search.setAttribute('name', 'services');
               search_title.innerText = 'Services';
               sessionStorage.setItem('search_type', 'services');
          }
          for (let j = 0; j < types.length; j++) {
               if (j == i) {
                    continue;
               }
               types[j].style.borderBottom = "none";
          }
     });
}
if(sessionStorage.getItem('search_type') == 'all'){
     search.setAttribute('placeholder', 'sections, services');
     search.setAttribute('name', 'all');
     search_title.innerText = 'Search All';
     types[0].style.borderBottom = "3px solid black";
     types[1].style.borderBottom = "none";
     types[2].style.borderBottom = "none";
}else if(sessionStorage.getItem('search_type') == 'services'){
     search.setAttribute('placeholder', 'services');
     search.setAttribute('name', 'services');
     search_title.innerText = 'Services';
     sessionStorage.setItem('search_type', 'services');
     types[2].style.borderBottom = "3px solid black";
     types[1].style.borderBottom = "none";
     types[0].style.borderBottom = "none";
}else if(sessionStorage.getItem('search_type') == 'sections'){
     search.setAttribute('placeholder', 'sections');
     search.setAttribute('name', 'sections');
     search_title.innerText = 'Sections';
     types[1].style.borderBottom = "3px solid black";
     types[0].style.borderBottom = "none";
     types[2].style.borderBottom = "none";
}