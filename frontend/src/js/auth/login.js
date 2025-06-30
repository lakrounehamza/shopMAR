if(sessionStorage.getItem('token')) {
if(sessionStorage.getItem('role') === 'admin') 
    window.location.href = "./clients/home.html";
else if(sessionStorage.getItem('role') === 'livreur')
    window.location.href = "client/home.html";
else if(sessionStorage.getItem('role') === 'client')
    window.location.href = "client/home.html";
}
var email = document.getElementById("email");
var password = document.getElementById("password");
var loginBtn = document.getElementById("loginBtn");

loginBtn.addEventListener("click", function (event) {
    event.preventDefault();

    var emailValue = email.value.trim();
    var passwordValue = password.value.trim();

    if (emailValue === "" || passwordValue === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Champs manquants',
            text: 'Veuillez remplir tous les champs.',
        });
        return;
    }

    // ⏳ Afficher l'animation de chargement
    Swal.fire({
        title: 'Connexion en cours...',
        text: 'Veuillez patienter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    var data = {
        email: emailValue,
        password: passwordValue
    };

    fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur de connexion");
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Connexion réussie !',
                    text: 'Redirection vers la page d’accueil...',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    sessionStorage.setItem('user_id', data.data.user.id);
                    sessionStorage.setItem('role', data.data.user.role);
                    sessionStorage.setItem('token', data.data.token);
                    if (data.data.user.role === 'admin')
                        window.location.href = "./clients/home.html";
                    else if (data.user.role === 'livreur')
                        window.location.href = "client/home.html";
                    else if (data.user.role === 'client')
                        window.location.href = "client/home.html";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Échec',
                    text: 'Identifiants incorrects. Veuillez réessayer.',
                });
            }
        })
        .catch(error => {
            console.error("Erreur:", error);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur s\'est produite. Veuillez réessayer plus tard.',
            });
        });
});
