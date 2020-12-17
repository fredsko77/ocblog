# ocblog

Installation du projet 

1. Cloner le dépôt où vous voulez pour récupérer le code source:
git clone https://github.com/fredsko77/ocblog.git

2. Installer les dépendances: 
composer install

3. Mettre à jour les fichiers de configuration: 
- /config/mail.php : configurer le smtp
- /config/database : configurer la connexion à la base de données

4. Récupérer la base de données 
Créer une base de données et importer le fichier ocblog.sql situé à la racine

5. Lancer le serveur:
php -S localhost:3000 -t public 

5. Un utilisateur est défini par défaut: 
nom d'utilisateur : admin@mail.com
mot de passe : 123MSBlog