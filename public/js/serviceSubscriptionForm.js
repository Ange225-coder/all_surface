document.addEventListener("DOMContentLoaded", function() {
    var toggleFormLink = document.getElementById("toggleFormLink");
    var subscriptionForm = document.getElementById("subscriptionForm");

    toggleFormLink.addEventListener("click", function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien

        // Toggle la classe 'hidden'
        if (subscriptionForm.style.display === "none") {
            subscriptionForm.style.display = "block";
        } else {
            subscriptionForm.style.display = "none";
        }
    });
});