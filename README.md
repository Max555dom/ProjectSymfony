# sfy-m1web

---

## Rappel

Une évaluation est **STRICTEMENT** personnelle, elle ne peut pas être faite en groupe.

À la fin de l’évaluation, envoyez un email à l'adresse - lkhouri92@gmail.com - spécifiant le **lien vers le dépôt Git** contenant votre évaluation.

## Évaluation

Implémenter la recherche par catégorie

Effectuer une recherche sur le nom des catégories en saisissant les premières lettres, puis afficher tous les gifs contenus dans les catégories trouvées

Si la recherche correspond à une catégorie principale, afficher tous les gifs de ses sous-catégories

---

## Principales commandes

### Commandes générales

`symfony check:req` : vérifier les exigences d'un projet Symfony

`symfony server:ca:install` : créer un certificat local pour bénéficier du https

`symfony new <DOSSIER>` : créer un nouveau projet Symfony

`symfony serve` : lancer le serveur PHP

`symfony console` : lister toutes les commandes d'un projet Symfony

`symfony console cache:clear` : supprimer le cache d'un projet Symfony

### Commandes de référence

`symfony console debug:router` : lister les routes

`symfony console debug:twig` : lister les fonctions, filtres et variables globales de Twig

`symfony console debug:container` : lister les services

### Commandes de création de modèles

`symfony console make:twig-extension` : créer une extension Twig

`symfony console make:form` : créer une classe de formulaire

`symfony console make:subscriber` : créer une classe de souscripteur d'événements Symfony

### Commandes liées à Doctrine

`symfony console doctrine:database:create` : créer la base de données

`symfony console doctrine:database:drop --force` : supprimer la base de données

`symfony console make:entity` : créer/modifier une entité

`symfony console make:entity --regenerate` : créer les accesseurs/mutateurs des nouvelles propriétés d'une entité

`symfony console make:entity --regenerate --overwrite` : recréer tous les accesseurs/mutateurs d'une entité

`symfony console make:migration` : créer les migrations de la base de données

`symfony console doctrine:migrations:migrate` : exécuter les migrations

`symfony console make:fixtures` : créer un modèle de données fictives

`symfony console doctrine:fixtures:load` : charger les données fictives

### Commandes liées à la sécurité

`symfony console make:user` : créer une entité de comptes utilisateurs

`symfony console make:auth` : créer un authentificateur de comptes utilisateurs

`symfony console make:registration-form` : créer un formulaire de création de comptes utilisateur

## Principaux composants

`composer require <COMPOSANT>` : installer un composant ou une dépendance

`annot` : utiliser les annotations

`twig` : utiliser le moteur de template [Twig](https://twig.symfony.com/)

`debug` : gérer le débogage

`asset` : utiliser des ressources externes dans Twig

`make` : créer des modèles de classes PHP

`encore` : utiliser webpack pour gérer les fichiers JS et CSS

`form` : créer des formulaires

`validator` : créer des contraintes de validation sur les champs de formulaires

`mailer` : gérer les emails

`orm` : utiliser l'ORM [Doctrine](https://www.doctrine-project.org/projects/orm.html)

`ormfixtures` : créer des données fictives pour Doctrine

`string` : gérer les chaînes de caractères

`security` : authentification et autorisations

## Références

Documentation : <https://symfony.com/doc/current/index.html>

Champs de formulaire : <https://symfony.com/doc/current/reference/forms/types.html>

Contraintes de validation sur les champs de formulaire  : <https://symfony.com/doc/current/reference/constraints.html>

## Plan de cours

* Pré-requis

	* [PHP](https://www.php.net/), accessible par le terminal

	* [Composer](https://getcomposer.org/)

	* [Git](https://git-scm.com/)

	* [MySQL](https://www.mysql.com/fr/)

* Installation de Symfony CLI

* Pré-requis à la création d'un projet Symfony

	* Vérifier les exigences d'un projet Symfony

	* Créer un certificat local

* Création d'un projet Symfony

* Création du premier contrôleur

	* Request et Response

	* Afficher une vue Twig

* Gestion des routes

	* Créer une route avec des annotations

	* Créer une route avec un paramètre

* Twig

	* Principaux fonctions et filtres

	* Créer une extension Twig

	* Gérer la mise en page

* Gérer les fichiers JS et CSS

	* Utilisation du composant Encore

	* Installation de Bootstrap et jQuery

* Gérer les formulaires

	* Créer une classe de formulaire

	* Gérer les champs de formulaire

	* Gérer les contraintes de validation des champs de formulaire

	* Gérer un formulaire dans un contrôleur

	* Fonctions Twig liées aux formulaires

* Doctrine

	* Création et connexion à une base de données

	* Créer une entité

	* Créer des contraintes sur les entités

	* Créer et exécuter des migrations

	* Créer des données fictives

	* Méthodes de sélection par défaut des classes de dépôt

* Création d'un espace d'administration

	* Ajouter, modifier et supprimer une entité

	* Gestion des fichiers

	* Souscripteur d'événements de formulaire

* Requêtes personnalisées avec Doctrine

	* Utilisation du Doctrine Query Language

	* Les différents modes de récupération des résultats

* Utilisation de l'AJAX

	* Récupération du contenu de la requête HTTP

	* Créer des réponses HTTP en JSON

* Sécurité

	* Gestion de l'authentification

	* Gestion des autorisations
