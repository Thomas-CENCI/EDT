# EDT
Le logiciel d'emploi du temps que vous connaissez permet de faire remonter des quantités d'informations sur les enseignements, étudiants, enseignants, salles, dates, horaires... Les données collectées depuis ADE sont remontées sous un format statique qui rend difficile leur exploitation. Les données d'ADE sont déjà en partie traitées pour tout ce qui est de type CM, TD ou TP, mais pour les activités d'un autre type, un traitement manuel est nécessaire. Il s'agit pour ce projet de concevoir et mettre en place une application web qui permet d'automatiser ces traitements, par l'extraction de données selon certains critères (exemple : activités d'un certain type, ou activité comportant une ressource particulière ...) à des fins de gestion. L'application devrait permettre : - de choisir des critères d'extraction des données et pouvoir les combiner (exemple : ressource APP-IAI et ressource Jean-Jacques Curtelin présentes dans l'activité) - d'extraire les données en question depuis ADE et les stocker dans une base de données en vue de leur exploitation (comptabilité des heures...) - d'effectuer des requêtes sur la base de données selon les critères choisis.

## Contributors
###### VIEU Loïc
###### GOSSELIN Rémi
###### RAZAFINDRABE Noah
###### CENCI Thomas
###### LABIDOUILLE Joe

## Ideas
- Rémi: Recherche edt/ req
- Noah: Base du site  (affichage, structure)
- Thomas: Bootstrap / git
- Loïc: Modèle relationelle



 L'application devrait permettre : 
     
- de choisir des critères d'extraction des données et pouvoir les combiner (exemple : ressource APP-IAI et ressource Jean-Jacques Curtelin présentes dans l'activité) 

- d'extraire les données en question depuis ADE et les stocker dans une base de données en vue de leur exploitation (comptabilité des heures...) 

- d'effectuer des requêtes sur la base de données selon les critères choisis.




Idées

 - bouton ajouter activité -> affiche formulaire (nom activité, type : CC, conférence, sortie, ...), description, promotion, date, heure_début, heure_fin) (+ proposition automatique d'ajout, calcul date et heure qui conviennent pour l'enseignant et la promotion) 
 -bouton modifier activité
 -bouton supprimer activité

- connexion en mode enseignant :
    -ajout de conférence en renseignant les salles disponibles, les heures disponibles, les étudiants conviés, etc...

-connexion en mode etudiant:
    -demande de modification de créneau
    -demande de réservation de salle
    
    
    
    

EDT.php?page=

page1 :  connexion
page2: EDT
