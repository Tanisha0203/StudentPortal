const inputFile = document.querySelector('#uploadfile');
const imgArea = document.querySelector('.img-area');

inputFile.addEventListener('change', function () {
    const image = this.files[0];
    console.log(image);
    if (image.size < 2000000) {
        const reader = new FileReader();
        reader.onload = () => {
            const currentImg = imgArea.querySelector('img');
            if (currentImg) {
                imgArea.removeChild(currentImg);
            }
            const imgUrl = reader.result;
            const img = document.createElement('img');
            img.src = imgUrl;
            imgArea.appendChild(img);
            imgArea.classList.add('active');
            imgArea.dataset.img = image.name;
        };
        reader.readAsDataURL(image);
    } else {
        alert("Image size exceeds 2MB");
    }
});
