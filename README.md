# Hot Takes - Une application web permettant aux utilisateurs de partager et d'évaluer des sauces piquantes

## Loustau-Cazaux David
## Réalisé dans le cadre d'un mini-projet étudiant en BUT Informatique à l'IUT d'Anglet.
## BUT2 - S4 - 2025

### Prérequis

- PHP
- Composer
- NPM
- Serveur BD. Testé avec MySQL.

### Installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/loustaucazauxdavid/projetsauces.git
   cd projetsauces
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances NPM**
   ```bash
   npm install
   ```

4. **Configuration de la base de données**
   - Copier le fichier `.env.example` vers `.env`
   - Configurer les variables de connexion à la base de données dans `.env`
   Exemple :
   ``` 
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=projetsauces
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Générer la clé d'application Laravel**
   ```bash
   php artisan key:generate
   ```

6. **Lancer les migrations**
   ```bash
   php artisan migrate
   ```

7. **Lancer l'application**
   ```bash
   # Méthode la plus simple en mode développeur :
   composer run dev
   ```
