// Preview voor nieuwe profile image
window.onload = () => {
    const uploadImgInput = document.querySelector("input[type=file][name=imgToUpload]");
    const newProfileImg = document.querySelector("img[name=newProfileImg]");
    const previewImg = document.querySelectorAll("images span.material-symbols-rounded, images img[name = newProfileImg]");
    const reader = new FileReader();

    reader.onload = () => {
        newProfileImg.src = reader.result;
    };
    // zoek het bestand en laat het zien als er een bestand is geupload
    uploadImgInput.addEventListener("change", () => {
        if (uploadImgInput.files.length > 0) {
            const file = uploadImgInput.files[0];
            reader.readAsDataURL(file);
            previewImg.forEach(img => img.style.display = "unset");
        } else {
            previewImg.forEach(img => img.style.display = "none");
        }
    });
}