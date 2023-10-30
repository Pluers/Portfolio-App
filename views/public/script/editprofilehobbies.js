window.onload = () => {
    let hobbiesSelect = document.getElementById('hobbySelection');
    let createHobbySection = document.getElementById('createHobbyForm');
    let addHobbyButton = document.querySelector("input[name=add_hobby_to_profile]");
    let createHobbyButton = document.querySelector("input[name=create_hobby]");
    let importImage = document.querySelector("form[name=import_image]");
    hobbiesSelect.addEventListener('change', () => {
        if (hobbiesSelect.value === "0") {
            addHobbyButton.disabled = true;
        } else if (hobbiesSelect.value === 'create_new_hobby') {
            createHobbySection.style.display = 'flex';
            addHobbyButton.style.display = 'none';
        } else {
            createHobbySection.style.display = 'none';
            addHobbyButton.style.display = 'flex';
            addHobbyButton.disabled = false;
        }
    });
}