# Instalation du site web
La base de données utilisées est hébergée par un cloud gratuit, il y a donc quelques problèmes pour se connecter en fin de journée.

Une fois le code installée en local la page de connextion est la suivante :
http://localhost/edt/php/edt_connexion.php

Voici les comptes  :<br/>

Administarteur<br/>
 identifiant : vieuL<br/>
 mots de passe : mdploic<br/>
 <br/>
Professeur <br/>
 identifiant : sebastienM<br/>
 mots de passe : mdpSebastien<br/>
 <br/>
Elève <br/>
 identifiant : thomasC<br/>
 mots de passe : mdpThomas<br/>
<br/>


# EDT
Le logiciel d'emploi du temps que vous connaissez permet de faire remonter des quantités d'informations sur les enseignements, étudiants, enseignants, salles, dates, horaires... Les données collectées depuis ADE sont remontées sous un format statique qui rend difficile leur exploitation. Les données d'ADE sont déjà en partie traitées pour tout ce qui est de type CM, TD ou TP, mais pour les activités d'un autre type, un traitement manuel est nécessaire. Il s'agit pour ce projet de concevoir et mettre en place une application web qui permet d'automatiser ces traitements, par l'extraction de données selon certains critères (exemple : activités d'un certain type, ou activité comportant une ressource particulière ...) à des fins de gestion. L'application devrait permettre : - de choisir des critères d'extraction des données et pouvoir les combiner (exemple : ressource APP-IAI et ressource Jean-Jacques Curtelin présentes dans l'activité) - d'extraire les données en question depuis ADE et les stocker dans une base de données en vue de leur exploitation (comptabilité des heures...) - d'effectuer des requêtes sur la base de données selon les critères choisis.

## Contributors
###### VIEU Loïc
###### GOSSELIN Rémi
###### RAZAFINDRABE Noah
###### CENCI Thomas

## Ideas
- Rémi: Recherche edt/ req
- Noah: Base du site  (affichage, structure)
- Thomas: Bootstrap / git
- Loïc: Modèle relationelle



 L'application devrait permettre : 
     
- de choisir des critères d'extraction des données et pouvoir les combiner (exemple : ressource APP-IAI et ressource Jean-Jacques Curtelin présentes dans l'activité) 

- d'extraire les données en question depuis ADE et les stocker dans une base de données en vue de leur exploitation (comptabilité des heures...) 

- d'effectuer des requêtes sur la base de données selon les critères choisis.


