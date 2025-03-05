
Explication des données
#Cas 0 :
Je suis OMIYALE Esaie, étudiant en troisième année de licence informatique parcours MIAGE ( Méthode Informatique
Appliquée à la Gestion) à l'université de Rennes.
Pour pouvoir compiler ce projet il vous faire :

- php artisan migration : pour créer les différentes tables ( Contributions, Invitations et les autres tables qui sont dans le data.sql)
- Ensuite exporter le fichier data.sql joint à ce projet


#Premier cas :  Propositions de Modifications

Lorsqu'un utilisateur propose une modification, une nouvelle entrée est insérée dans la table CONTRIBUTIONS

Les champs suivants sont remplis :
  - created_by : Id de l'utilisateur ayant proposé la modification.
  - relationship_id : Identifiant de la relation existante (NULL si c'est une nouvelle relation).
  - parent_id et child_id : Identifiants des entités concernées.
  - users_accept et users_reject : Champs JSON initialisés à des listes vides pour suivre les votes des utilisateurs.
  - confirm_relation : Défini par défaut à false, indiquant que la modification est en attente de validation.

Mise à jour des votes : Les utilisateurs peuvent accepter ou rejeter une proposition :

- Les votes favorables sont ajoutés dans le champ users_accept.
- Les votes défavorables sont ajoutés dans le champ users_reject.

#Deuxième cas : Validation des Modifications

Ce cas ci se passe en deux phases:
A) Les votes
Un utilisateur connecté à la possiblité de confirmer ou de rejeter une demande de modification ou une nouvelle relation.

Lorsque ce dernier appuis sur
- Confirm : son id est ajouter directment à la liste des utilisateurs qui ont deja acceptés cette contributions avant lui.
- Reject : son id est ajouter directment à la liste des utilisateurs qui ont deja rejetés cette contributions avant lui.

B) La décision

Lors des votes, si le nombre de personnes ayant coonfirmées la confirmation atteint 3 avant le nombre de personnes ayant rejetées,
cette contribution est validées aors directment et donc cette relation est amenée dans la table RELATIONSHIP.
Tandisque si c'est le nombre de rejet qui atteint en premier 3, la contribution n'est pas validée et ne fera plus objet de vote.
