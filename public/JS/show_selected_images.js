const imageInput = document.getElementById('imageInput');
const imageContainer = document.getElementById('imageContainer');
let filesArray = [];

imageInput.addEventListener('change', (event) => {
     filesArray = Array.from(event.target.files);
     displayImages(filesArray);
});

function displayImages(files) {
     imageContainer.innerHTML = '';

     files.forEach((file, index) => {
          const reader = new FileReader();
          reader.onload = (e) => {
               const imageWrapper = document.createElement('div');
               const separator = document.createElement('div');
               imageWrapper.classList.add('image-wrapper');
               separator.classList.add('image-separator');
               const img = document.createElement('img');
               img.src = e.target.result;

               const removeBtn = document.createElement('button');
               removeBtn.textContent = 'remove';
               removeBtn.classList.add('remove-btn');
               removeBtn.addEventListener('click', () => {
                    filesArray.splice(index, 1);
                    updateInputFiles();
                    displayImages(filesArray);
               });

               imageWrapper.appendChild(img);
               imageWrapper.appendChild(removeBtn);
               imageContainer.appendChild(imageWrapper);
               imageContainer.appendChild(separator);
          };
          reader.readAsDataURL(file);
     });
}

function updateInputFiles() {
     const dataTransfer = new DataTransfer();
     filesArray.forEach(file => dataTransfer.items.add(file));
     imageInput.files = dataTransfer.files;
}