# cmrweb/cmrframework
**[cmrframework](http://cmrweb.fr) inBulid**
 
 ![install gif](https://media.giphy.com/media/THxXanoyOd88Grrd1w/giphy.gif)

 [doc video](https://www.youtube.com/watch?v=InM_uDLBm7Q)

 
  * Install
    -  [WAMPServer](http://wampserver.com)
    -  [composer](https://getcomposer.org/download/)
    - `composer create-project cmrweb/cmrframework:dev-master nom_du_projet` 

  * Usage
    - `cd lib`
    - `cli/cmr`
    - cmr `help`
    - cmr `start`
    - cmr `generate table nom-type-valeur nom-type-valeur-table.field`
   
  * Les types 
    - Tous les types sql : varchar int date text ...
    - char      = varchar
    - password  = varchar + input type password + hash
    - pwd       = varchar + input type password + hash
    - image     = varchar + input type file + upload in asset/img/upload
    - file      = varchar + input type file + upload in asset/img/upload
  
  * Exemple
  
  
     Créer une table utilisateur avec les champs nom, prenom, age.    
    - cmr `generate utilisateur nom-char-255 prenom-char-255 age-int-3`
    
     Créer une table actif avec la clé étrangère de la table utilisateur et un champ date
    - cmr `generate actif user_id-int-11-utilisateur.id is_actif-date`
 

 [docs pdf](https://docs.google.com/presentation/d/1FP2pDqd5z5KtJ_tku4P9MljjPUj33xVLkF9VqpDlFII/edit?usp=sharing)

