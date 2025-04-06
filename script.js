// Function to Show Sections
function showSection(sectionId) {
    document.querySelectorAll('.user-section').forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';
}
// Function to validate password match
document.addEventListener("DOMContentLoaded", function () {
    function validatePassword(event) {
        let form = event.target;
        let password = form.querySelector("input[name='password']").value;
        let confirmPassword = form.querySelector("input[name='confirm-password']").value;

        if (password !== confirmPassword) {
            event.preventDefault();
            alert("Passwords do not match!");
        }
    }

    document.getElementById("signupForm")?.addEventListener("submit", validatePassword);
    document.getElementById("addUserForm")?.addEventListener("submit", validatePassword);
});
//Function to move to the next input when pressing enter
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent form submission
                let inputs = Array.from(form.querySelectorAll("input"));
                let index = inputs.indexOf(document.activeElement);

                if (index !== -1 && index < inputs.length - 1) {
                    inputs[index + 1].focus(); // Move to the next input
                }
            }
        });
    });
});