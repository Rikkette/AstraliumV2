//ecouteur d'evenement 
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.form-connexion'); // suppose que le formulaire a la classe .form-connexion
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    // gestion des erreurs de connexion
    const erreurs = {
        email: document.getElementById('email-error'),
        password: document.getElementById('password-error'),
    };
    //regex
    function validerEmail(email) {
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{3,}$/;
        return regex.test(email.trim());
    }
    //regex
    function validerPassword(password) {
        const regex = /^(?=.*\d)(?=.*[!@#$%^&*(),.?:{}|\\\/])[a-zA-Z0-9!@#$%^&*(),.?:{}|\\\/]{8,}$/;
        return regex.test(password.trim());
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // empêche l'envoi du formulaire par défaut
        let isValid = true;

        // Réinitialise les messages d'erreur
        Object.values(erreurs).forEach(erreur => erreur.textContent = '');

        // Validation email
        if (!validerEmail(email.value)) {
            erreurs.email.textContent = 'Email non valide';
            isValid = false;
        }

        // Validation mot de passe
        if (!validerPassword(password.value)) {
            erreurs.password.textContent = 'Mot de passe non valide';
            isValid = false;
        }

        if (isValid) {
            form.submit();
        } else {
            alert('Veuillez corriger les erreurs avant de soumettre le formulaire.');
        }
    });
});
