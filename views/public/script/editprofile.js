window.onload = () => {
    let uploadImgInput = document.querySelector("input[type=file][name=imgToUpload]");
    let newProfileImg = document.querySelector("img[name=newProfileImg]");

    uploadImgInput.addEventListener("change", () => {
        let file = uploadImgInput.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);
        console.log(reader);
        reader.onload = () => {
            newProfileImg.src = reader.result;
        };
    });
}