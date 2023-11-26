window.onload = () => {
    const jobexperienceSelect = document.getElementById('jobexperienceSelection');
    const createJobexperienceSection = document.getElementById('createJobexperienceForm');
    const addJobexperienceButton = document.querySelector("input[name=add_jobexperience_to_profile]");

    // als er in de select list, voor de optie is gekozen om een nieuwe jobexperience te maken, dan laat de create jobexperience section zien
    jobexperienceSelect.addEventListener('change', () => {
        // check of de create new hobby is geselecteerd in de jobexperience select
        const isCreateNewJobexperience = jobexperienceSelect.value === "create_new_jobexperience";
        createJobexperienceSection.style.display = isCreateNewJobexperience ? 'flex' : 'none';
        addJobexperienceButton.style.display = isCreateNewJobexperience ? 'none' : 'flex';
        addJobexperienceButton.disabled = isCreateNewJobexperience || jobexperienceSelect.value === "0";
    });
}
