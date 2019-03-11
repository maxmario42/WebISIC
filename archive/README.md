Projet-Web - DRACAR
===================

Inroduction
-----------

Le projet Web est un projet en binôme de deuxième année à l'école IMT Lille Douai.
Il a pour but d'enseigner plusieurs technologies web (PHP, SQL, HTML, CSS) afin d'initier les étudiants à ce domaine.
Ce projet ne doit pas utiliser de framework, néanmoins ce-dernier sera construit manuellement en suivant l'architecture MVC.
Cette année l'objectif est de construire un site web permettant de favoriser le covoiturage entre les acteurs de l'IMT Lille Douai.

Dracar est le nom de notre Site.

Developpement
-------------

Suivez les étapes ci-dessous afin d'avoir une copie fonctionnelle du site

Téléchargement du projet
- `git clone`
- `cd projet-web`

Initialisation de la base de données
- Importer dans votre base de données le fichier `sql/crebas.sql`
- Importer les données dans votre base à l'aide du fichier `sql/dracar_dev.sql`

Configurer votre environnement
- Copier coller `config/config.php.dist` vers `config/config.php`
- Remplacer les informations présentes dedans pour permettre la connection à votre base de données

Architecture du Projet
----------------------
- `assets`: Fichiers publics
- `classes`: Divers classes génériques
- `config`: Fichiers de configuration
- `controller`: Controllers
- `model`: Ensemble des modèles de donnée
- `repository`: Ensemble des requêtes pour accéder aux données
- `sql`: Fichiers SQL permettant l'initialisation de la base de données
    - `sql/dracar.sql`: Schéma de la base de donnée
    - `sql/dracar_dev.sql`: Fichier sql pour le développement (base de donnée "conséquente")
        - Comptes:
            - admin: `admin@example.com`, `admin` (Agent)
            - user: `user@example.com`, `user` (Étudiant, a créé un trajet)
            - moderator: `moderator@example.com`, `moderator` (Modérateur du trajet)
    - `sql/dracar_prod.sql`: Fichier sql pour la mise en production, juste un compte `admin@example.com`, `admin`
- `templates`: Vues HTML du projet
- `view`: Composants permettants ded gérer les vues
