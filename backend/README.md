## 🚀 Installation et Déploiement

### 🔧 Prérequis

- PHP **8.3.14**
- MySQL
- Serveur Web (Apache ou Nginx)
- **Composer**
- **Node.js** (avec npm)

---

### 📦 Installation

1. **Cloner le projet :**
    ```bash
    git clone https://github.com/lakrounehamza/shopMAR.git
    cd shopMAR
    ```

2. **Installer les dépendances PHP et JS :**
    ```bash
    composer install
    npm install
    npm run build
    ```

3. **Configurer l’environnement :**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    ➡️ Ensuite, modifie `.env` pour ajouter les bonnes informations de connexion à ta base de données :
    ```env
    DB_DATABASE=nom_de_ta_base
    DB_USERNAME=ton_utilisateur
    DB_PASSWORD=ton_mot_de_passe
    ```

4. **Exécuter les migrations + seeders (si existants) :**
    ```bash
    php artisan migrate --seed
    ```

5. **Démarrer le serveur de développement :**
    ```bash
    php artisan serve
    ```