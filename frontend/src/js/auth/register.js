const roleInputs = document.querySelectorAll('input[name="role"]');
const clientFields = document.getElementById('clientFields');
const livreurFields = document.getElementById('livreurFields');
const adminFields = document.getElementById('adminFields');

function updateFormFields() {
    const selectedRole = document.querySelector('input[name="role"]:checked').value;

    clientFields.classList.add('hidden');
    livreurFields.classList.add('hidden');
    adminFields.classList.add('hidden');

    document.querySelectorAll('#clientFields input, #clientFields select').forEach(input => {
        input.removeAttribute('required');
    });
    document.querySelectorAll('#livreurFields input, #livreurFields select').forEach(input => {
        input.removeAttribute('required');
    });

    switch (selectedRole) {
        case 'client':
            clientFields.classList.remove('hidden');
            document.querySelectorAll('#clientFields input, #clientFields select').forEach(input => {
                input.setAttribute('required', 'required');
            });
            break;
        case 'livreur':
            livreurFields.classList.remove('hidden');
            document.querySelector('#livreurFields select[name="zoneTravail"]').setAttribute('required', 'required');
            break;
        case 'admin':
            adminFields.classList.remove('hidden');
            break;
    }
}

roleInputs.forEach(input => {
    input.addEventListener('change', updateFormFields);
});

updateFormFields();

// document.getElementById('registerForm').addEventListener('submit', async function (e) {
//     e.preventDefault();

//     const formData = new FormData(this);
//     const data = Object.fromEntries(formData.entries());
//     const role = data.role;

//     const userData = {
//         name: data.nom,
//         email: data.email,
//         password: data.password,
//         role: role,
//         telephone: data.telephone
//     };

//     try {
//         const userRes = await fetch("http://127.0.0.1:8000/api/register", {
//             method: "POST",
//             headers: { "Content-Type": "application/json" },
//             body: JSON.stringify(userData)
//         });
//         const userJson = await userRes.json();

//         if (!userRes.ok || !userJson.success || !userJson.data || !userJson.data.user) {
//             Swal.fire("Erreur", userJson.message || "Erreur lors de l'inscription.", "error");
//             return;
//         }

//         const userId = userJson.data.user.id;
//         //  console.log("User ID:", userId);
//         if (role === "client") {
//             const clientData = {
//                 id_user: userId,
//                 adresseVille: data.adresseVille,
//                 adresseRue: data.adresseRue,
//                 adresseCodePostal: data.adresseCode_postal,
//                 adressePays: data.adressePays
//             };
//             const clientRes = await fetch("http://127.0.0.1:8000/api/clients", {
//                 method: "POST",
//                 headers: { "Content-Type": "application/json" },
//                 body: JSON.stringify(clientData)
//             });
//             const clientJson = await clientRes.json();

//             if (!clientRes.ok || !clientJson.success) {
//                 Swal.fire("Erreur", clientJson.message || "Erreur lors de l'inscription client.", "error");
//                 return;
//             }

//             await Swal.fire("Succès", "Inscription client réussie !", "success");
//         }

//         else if (role === "livreur") {
//             const livreurData = {
//                 id_user: userId,
//                 zoneTravail: data.zoneTravail
//             };

//             const livreurRes = await fetch("http://127.0.0.1:8000/api/livreurs", {
//                 method: "POST",
//                 headers: { "Content-Type": "application/json" },
//                 body: JSON.stringify(livreurData)
//             });
//             const livreurJson = await livreurRes.json();

//             if (!livreurRes.ok || !livreurJson.success) {
//                 Swal.fire("Erreur", livreurJson.message || "Erreur lors de l'inscription livreur.", "error");
//                 return;
//             }

//             await Swal.fire("Succès", "Inscription livreur réussie !", "success");
//         }

//         else if (role === "admin") {
//             await Swal.fire("Succès", "Inscription administrateur réussie ! En attente de validation.", "success");
//         }

//         // Redirection commune après succès
//         window.location.href = "login.html";

//     } catch (error) {
//         Swal.fire("Erreur réseau", error.message, "error");
//     }
// });


document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    // Empêcher double soumission
    const form = this;
    if (form.classList.contains('submitted')) return;
    form.classList.add('submitted');

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    const role = data.role;

    const userData = {
        name: data.nom,
        email: data.email,
        password: data.password,
        role: role,
        telephone: data.telephone
    };

    try {
        const userRes = await fetch("http://127.0.0.1:8000/api/register", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(userData)
        });

        const userJson = await userRes.json();

        if (!userRes.ok || !userJson.success || !userJson.data || !userJson.data.user) {
            Swal.fire("Erreur", userJson.message || "Erreur lors de l'inscription.", "error");
            form.classList.remove('submitted');
            return;
        }

        const userId = userJson.data.user.id;

        if (role === "client") {
            const clientData = {
                id_user: userId,
                adresseVille: data.adresseVille,
                adresseRue: data.adresseRue,
                adresseCodePostal: data.adresseCode_postal,
                adressePays: data.adressePays
            };

            const clientRes = await fetch("http://127.0.0.1:8000/api/clients", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(clientData)
            });

            const clientJson = await clientRes.json();

            if (!clientRes.ok || !clientJson.success) {
                Swal.fire("Erreur", clientJson.message || "Erreur lors de l'inscription client.", "error");
                form.classList.remove('submitted');
                return;
            }

            await Swal.fire("Succès", "Inscription client réussie !", "success");

        } else if (role === "livreur") {
            const livreurData = {
                id_user: userId,
                zoneTravail: data.zoneTravail
            };

            const livreurRes = await fetch("http://127.0.0.1:8000/api/livreurs", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(livreurData)
            });

            const livreurJson = await livreurRes.json();

            if (!livreurRes.ok || !livreurJson.success) {
                Swal.fire("Erreur", livreurJson.message || "Erreur lors de l'inscription livreur.", "error");
                form.classList.remove('submitted');
                return;
            }

            await Swal.fire("Succès", "Inscription livreur réussie !", "success");

        } else if (role === "admin") {
            await Swal.fire("Succès", "Inscription administrateur réussie ! En attente de validation.", "success");
        }

        window.location.href = "login.html";

    } catch (error) {
        Swal.fire("Erreur réseau", error.message, "error");
        form.classList.remove('submitted');
    }
});
