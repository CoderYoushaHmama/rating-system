const inputPhoto = document.getElementById('file');
const previewImage = document.getElementById('image');
const inputPhoto2 = document.getElementById('file2');
const previewImage2 = document.getElementById('image2');

inputPhoto.addEventListener('change',function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.addEventListener("load",function(){
            previewImage.setAttribute("src",this.result);
        });
        reader.readAsDataURL(file);
    }
});
inputPhoto2.addEventListener('change',function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.addEventListener("load",function(){
            previewImage2.setAttribute("src",this.result);
        });
        reader.readAsDataURL(file);
    }
});