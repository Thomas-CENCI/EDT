
# Projet INFO642 - Emploi du temps

## Enoncé 
Le logiciel d'emploi du temps que vous connaissez permet de faire remonter des quantités d'informations sur les enseignements, étudiants, enseignants, salles, dates, horaires...
Les données collectées depuis ADE sont remontées sous un format statique qui rend difficile leur exploitation. Les données d'ADE sont déjà en partie traitées pour tout ce qui est de type CM, TD ou TP, mais pour les activités d'un autre type, un traitement manuel est nécessaire
Il s'agit pour ce projet de concevoir et mettre en place une application web qui permet d'automatiser ces traitements, par l'extraction de données selon certains critères (exemple : activités d'un certain type, ou activité comportant une ressource particulière ...) à des fins de gestion. L'application devrait permettre : - de choisir des critères d'extraction des données et pouvoir les combiner (exemple : ressource APP-IAI et ressource Jean-Jacques Curtelin présentes dans l'activité) - d'extraire les données en question depuis ADE et les stocker dans une base de données en vue de leur exploitation (comptabilité des heures...) - d'effectuer des requêtes sur la base de données selon les critères choisis.

## Installation du site web
La base de données est hébergée par un service cloud, des soucis de connexion sont possibles.
Dans le cas où le service cloud ne serait pas disponible, une restauration de base est possible à partir du dump présent.
*Remarque : Les identifiants de connexion devront être modifiés dans le code*

Il est recommandé d'utiliser Mamp (MacOS), WampServer (Windows) pour exécuter le site.

## Lancement
Accédez à l'adresse suivante :  [cliquez-ici](http://localhost/edt/php/edt_main.php)

Une authentification est nécessaire pour accéder aux différents services. Des fonctionnalités différentes sont proposées en fonction du rôle de l'utilisateur.

### Comptes disponibles :
|                |                |                |                 | 
|----------------|----------------|----------------|----------------|
|**Identifiant**|vieuL | sebastienM | thomasC |
|**Mot de passe**| mdpLoic | mdpSebastien | mdpThomas
|**Rôle**| Administrateur | Enseignant | Elève

## Contributeurs :

 - [Thomas-CENCI](http://github.com/Thomas-CENCI/)
  - [NoahRz](https://github.com/NoahRz)
 - [VieuL](https://github.com/vieul)
 - [Rem-G](http://github.com/Rem-G)

