window.onload = () => {
    let uploadImgInput = document.querySelector("input[type=file][name=imgToUpload]");
    let newProfileImg = document.querySelector("img[name=newProfileImg]");
    let previewImg = document.querySelectorAll("images span.material-symbols-rounded, images img[name = newProfileImg]");

    uploadImgInput.addEventListener("change", () => {
        if (uploadImgInput.files.length > 0) {
            let file = uploadImgInput.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(file);
            console.log(reader);
            reader.onload = () => {
                newProfileImg.src = reader.result;
            };
            previewImg.forEach(img => img.style.display = "unset");
        } else {
            previewImg.forEach(img => img.style.display = "none");
        }
    });
}