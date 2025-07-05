 
        let users = [
            { id: 1, name: 'Jean Dupont', email: 'jean.dupont@email.com', role: 'admin', status: 'active', date: '2024-01-15' },
            { id: 2, name: 'Marie Martin', email: 'marie.martin@email.com', role: 'user', status: 'active', date: '2024-01-20' },
            { id: 3, name: 'Pierre Durand', email: 'pierre.durand@email.com', role: 'moderator', status: 'inactive', date: '2024-01-25' }
        ];

        let products = [
            { id: 1, name: 'iPhone 15 Pro', price: 1299, category: 'electronics', stock: 25, image: 'fas fa-mobile-alt' },
            { id: 2, name: 'MacBook Pro', price: 2499, category: 'electronics', stock: 15, image: 'fas fa-laptop' },
            { id: 3, name: 'AirPods Pro', price: 249, category: 'electronics', stock: 50, image: 'fas fa-headphones' },
            { id: 4, name: 'T-Shirt Premium', price: 39, category: 'clothing', stock: 100, image: 'fas fa-tshirt' }
        ];

        let categories = [
            { id: 1, name: 'Électronique', description: 'Appareils électroniques et gadgets', icon: 'fas fa-mobile-alt', count: 156 },
            { id: 2, name: 'Vêtements', description: 'Mode et accessoires', icon: 'fas fa-tshirt', count: 89 },
            { id: 3, name: 'Livres', description: 'Livres et publications', icon: 'fas fa-book', count: 234 },
            { id: 4, name: 'Maison', description: 'Décoration et mobilier', icon: 'fas fa-home', count: 67 }
        ];

        let orders = [
            { id: 1001, customer: 'Jean Dupont', date: '2024-07-01', amount: 1299, status: 'delivered' },
            { id: 1002, customer: 'Marie Martin', date: '2024-07-02', amount: 249, status: 'processing' },
            { id: 1003, customer: 'Pierre Durand', date: '2024-07-03', amount: 2499, status: 'pending' },
            { id: 1004, customer: 'Sophie Bernard', date: '2024-07-04', amount: 89, status: 'delivered' }
        ];

        // Navigation
        function showSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionName + '-section').classList.add('active');

            // Update nav links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update header title
            const titles = {
                'dashboard': 'Tableau de Bord',
                'users': 'Gestion des Utilisateurs',
                'products': 'Gestion des Produits',
                'categories': 'Gestion des Catégories',
                'orders': 'Gestion des Commandes',
                'analytics': 'Statistiques Avancées',
                'settings': 'Paramètres'
            };
            document.querySelector('header h1').textContent = titles[sectionName];
        }

        // Modal functions
        function openUserModal() {
            document.getElementById('userModal').classList.add('active');
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.remove('active');
            document.getElementById('userForm').reset();
        }

        function openProductModal() {
            document.getElementById('productModal').classList.add('active');
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.remove('active');
            document.getElementById('productForm').reset();
        }

        function openCategoryModal() {
            document.getElementById('categoryModal').classList.add('active');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.remove('active');
            document.getElementById('categoryForm').reset();
        }

        // Data population functions
        function populateUsers() {
            const tbody = document.getElementById('usersTable');
            tbody.innerHTML = '';

            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-cordes-blue to-cordes-accent rounded-full flex items-center justify-center">
                        <span class="text-white font-medium">${user.name.charAt(0)}</span>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">${user.name}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${user.email}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${user.role}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="status-badge ${user.status === 'active' ? 'status-active' : 'status-inactive'}">${user.status}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${user.date}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                <button class="text-cordes-blue hover:text-cordes-dark">Modifier</button>
                <button class="text-red-600 hover:text-red-900" onclick="deleteUser(${user.id})">Supprimer</button>
            </td>
        `;
                tbody.appendChild(row);
            });
        }

        function populateProducts() {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';

            products.forEach(product => {
                const card = document.createElement('div');
                card.className = 'bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300';
                card.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-cordes-blue to-cordes-accent rounded-xl flex items-center justify-center">
                    <i class="${product.image} text-white"></i>
                </div>
                <div class="flex space-x-2">
                    <button class="text-gray-400 hover:text-cordes-blue">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-gray-400 hover:text-red-500" onclick="deleteProduct(${product.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">${product.name}</h3>
            <p class="text-gray-600 text-sm mb-4">${product.category}</p>
            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold text-cordes-blue">${product.price}€</span>
                <span class="text-sm text-gray-500">Stock: ${product.stock}</span>
            </div>
        `;
                grid.appendChild(card);
            });
        }

        function populateCategories() {
            const grid = document.getElementById('categoriesGrid');
            grid.innerHTML = '';

            categories.forEach(category => {
                const card = document.createElement('div');
                card.className = 'bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300';
                card.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                    <i class="${category.icon} text-white"></i>
                </div>
                <div class="flex space-x-2">
                    <button class="text-gray-400 hover:text-cordes-blue">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-gray-400 hover:text-red-500" onclick="deleteCategory(${category.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">${category.name}</h3>
            <p class="text-gray-600 text-sm mb-4">${category.description}</p>
            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold text-cordes-blue">${category.count}</span>
                <span class="text-sm text-gray-500">produits</span>
            </div>
        `;
                grid.appendChild(card);
            });
        }

        function populateOrders() {
            const tbody = document.getElementById('ordersTable');
            tbody.innerHTML = '';

            orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">#${order.id}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.customer}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.date}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${order.amount}€</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="status-badge status-${order.status}">${order.status}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                <button class="text-cordes-blue hover:text-cordes-dark">Voir</button>
                <button class="text-green-600 hover:text-green-900">Traiter</button>
            </td>
        `;
                tbody.appendChild(row);
            });
        }

  
 
 

   

  

        // Initialize dashboard
        function initializeDashboard() {
            // Populate all data
            populateUsers();
            populateProducts();
            populateCategories();
            populateOrders();
            updateDashboardStats();

 
        }

        // Start the application
        initializeDashboard();
          
function getAuthToken() {
    const token = sessionStorage.getItem('token');
    if (!token) {
        console.warn('Aucun token trouvé dans sessionStorage');
        return null;
    }
    return token;
}

function addCategory() {
    const token = getAuthToken();
    
    // Vérifier si le token existe
    if (!token) {
        Swal.fire({
            title: 'Erreur!',
            text: 'Vous devez être connecté pour effectuer cette action',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    const formCategory = document.getElementById('categoryForm');
    const name = document.getElementById('categoryName').value.trim();
    const des = document.getElementById('categoryDescription').value.trim();
    const icon = document.getElementById('categoryIcon').value.trim();
    
    // Validation des champs
    if (!name || !des) {
        Swal.fire({
            title: 'Erreur!',
            text: 'Veuillez remplir tous les champs obligatoires',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

    const data = {
        name: name,
        description: des,
        icon: icon
    };

    fetch("http://127.0.0.1:8000/api/categories", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + token   
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('Status de la réponse:', response.status);
        
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error("Token d'authentification invalide ou expiré");
            } else if (response.status === 403) {
                throw new Error("Accès refusé");
            } else {
                throw new Error(`Erreur ${response.status}: ${response.statusText}`);
            }
        }
        return response.json();
    })
    .then(data => {
        console.log('Données reçues:', data);
        
        if (data.success) {
            closeCategoryModal();
            Swal.fire({
                title: 'Succès!',
                text: 'Catégorie ajoutée avec succès',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            // Optionnel : recharger la liste des catégories
            // loadCategories();
        } else {
            Swal.fire({
                title: 'Erreur!',
                text: data.message || 'Erreur lors de l\'ajout de la catégorie',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        
        // Fermer le modal même en cas d'erreur
        closeCategoryModal();
        
        Swal.fire({
            title: 'Erreur!',
            text: error.message || 'Une erreur est survenue lors de l\'ajout',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}
 function updateDashboardStats() {}