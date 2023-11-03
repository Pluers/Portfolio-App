window.onload = () => {
    const jobexperienceSelect = document.getElementById('jobexperienceSelection');
    const createJobexperienceSection = document.getElementById('createJobexperienceForm');
    const addJobexperienceButton = document.querySelector("input[name=add_jobexperience_to_profile]");
    const createHobbyButton = document.querySelector("input[name=create_jobexperience]");
    // const importImage = document.querySelector("form[name=import_image]");

    jobexperienceSelect.addEventListener('change', () => {
        switch (jobexperienceSelect.value) {
            case "0":
                addJobexperienceButton.disabled = true;
                break;
            case "create_new_jobexperience":
                createJobexperienceSection.style.display = 'flex';
                addJobexperienceButton.style.display = 'none';
                break;
            default:
                createJobexperienceSection.style.display = 'none';
                addJobexperienceButton.style.display = 'flex';
                addJobexperienceButton.disabled = false;
        }
    });
}