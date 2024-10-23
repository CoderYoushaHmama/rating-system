var create_post_btn = document.getElementById('create-post-btn');
var create_post_section = document.getElementById('create-post-section');
var edit_post_section = document.getElementById('edit-post-section');
var background = document.getElementById('background');
var close_post_section_btn = document.getElementById('close-post-section-btn');
var close_edit_post_section_btn = document.getElementById('close-edit-post-section-btn');
var edit_btns = document.querySelectorAll('.edit-btn');
var post_texts = document.querySelectorAll('.post-text');
var post_images = document.querySelectorAll('.post-image');
var textarea = document.getElementById('textarea');
var form_edit = document.getElementById('form-edit');
var create_btn = document.getElementById('create-btn');
var edit_btn = document.getElementById('edit-btn');
var delete_btn = document.getElementById('delete-btn');
var add_comment = document.getElementById('add-comment');

var action = null;
var delete_action = null;

function setAction(action, delete_action) {
     this.action = action;
     this.delete_action = delete_action;
}

for (let i = 0; i < edit_btns.length; i++) {
     edit_btns[i].addEventListener('click', () => {
          edit_post_section.style.display = 'block';
          background.style.display = 'block';
          textarea.innerHTML = post_texts[i].innerText;
          previewImage2.setAttribute('src', post_images[i].getAttribute('src'));
          form_edit.setAttribute('action', action);
          delete_btn.setAttribute('href', delete_action);
     });
}

close_edit_post_section_btn.addEventListener('click', () => {
     edit_post_section.style.display = 'none';
     background.style.display = 'none';
});

textarea.addEventListener('input', () => {
     if (textarea.value) {
          edit_btn.removeAttribute('disabled');
     } else {
          edit_btn.setAttribute('disabled', true);
     }
});

create_post_btn.addEventListener('click', () => {
     create_post_section.style.display = 'block';
     background.style.display = 'block';
});

close_post_section_btn.addEventListener('click', () => {
     create_post_section.style.display = 'none';
     background.style.display = 'none';
});


file.addEventListener('change', () => {
     if (file.value && add_comment.value) {
          create_btn.removeAttribute('disabled');
     } else {
          create_btn.setAttribute('disabled', true);
     }
});
add_comment.addEventListener('input', () => {
     if (file.value && add_comment.value) {
          create_btn.removeAttribute('disabled');
     } else {
          create_btn.setAttribute('disabled', true);
     }
});