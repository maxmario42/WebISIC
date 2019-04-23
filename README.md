Projet-Web - Quiz en ligne
===================

Inroduction
-----------

Le projet Web est un projet de groupe de deuxième année à l'école IMT Lille Douai.
Le but est d'enseigner plusieurs technologies web (PHP, SQL, HTML, CSS).
Ce projet n'utilise pas de framework externe, on construit le notre en suivant l'architecture MVC.
L'objectif est de construire un site web permettant de réaliser des questionnaires en lignes.

Déploiement
-------------

Mode d'emploi :

Téléchargement du projet
- `git clone`
- `cd projet-web`

Initialisation de la base de données
- Importer dans votre base de données le fichier `sql/structure.sql`
- Importer les données de test dans votre base à l'aide du fichier `sql/data.sql`

Configurer votre environnements
- Editer le fichier `config/config.php` pour permettre la connection à votre base de données

Architecture du Projet
----------------------
- `assets`: Fichiers publics
- `classes`: Classes génériques
- `config`: Fichiers de configuration
- `controller`: Controllers
- `model`: Modèles de données
- `sql`: Fichiers SQL permettant l'initialisation de la base de données
    - `sql/structure.sql`: Schéma de la base de donnée
    - `sql/data.sql`: Données de test
- `templates`: Modèles de génération HTML
- `view`: Gestion des vues