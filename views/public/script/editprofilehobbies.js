window.onload = () => {
    const hobbiesSelect = document.getElementById('hobbySelection');
    const createHobbySection = document.getElementById('createHobbyForm');
    const addHobbyButton = document.querySelector("input[name=add_hobby_to_profile]");
    const createHobbyButton = document.querySelector("input[name=create_hobby]");
    //const importImage = document.querySelector("form[name=import_image]");

    hobbiesSelect.addEventListener('change', () => {
        switch (hobbiesSelect.value) {
            case "0":
                addHobbyButton.disabled = true;
                break;
            case "create_new_hobby":
                createHobbySection.style.display = 'flex';
                addHobbyButton.style.display = 'none';
                break;
            default:
                createHobbySection.style.display = 'none';
                addHobbyButton.style.display = 'flex';
                addHobbyButton.disabled = false;
        }
    });
}