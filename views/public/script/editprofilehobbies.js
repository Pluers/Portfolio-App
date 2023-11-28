window.onload = () => {
    const hobbiesSelect = document.getElementById('hobbySelection');
    const createHobbySection = document.getElementById('createHobbyForm');
    const addHobbyButton = document.querySelector("input[name=add_hobby_to_profile]");

    // als er in de select list, voor de optie is gekozen om een nieuwe hobby te maken, dan laat de create hobby section zien
    hobbiesSelect.addEventListener('change', () => {
        // check of de create new hobby is geselecteerd in de hobbies select
        const isCreateNewHobby = hobbiesSelect.value === "create_new_hobby";
        createHobbySection.style.display = isCreateNewHobby ? 'flex' : 'none';
        addHobbyButton.style.display = isCreateNewHobby ? 'none' : 'flex';
        addHobbyButton.disabled = isCreateNewHobby || hobbiesSelect.value === "0";
    });
}