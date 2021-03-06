# cmrweb/cmrframework
**[cmrframework](http://cmrweb.fr) inBulid**
 
 ![install gif](https://media.giphy.com/media/THxXanoyOd88Grrd1w/giphy.gif)

 [doc video](https://www.youtube.com/watch?v=InM_uDLBm7Q)

 ![usageconfig](https://cmrweb.fr/asset/img/cli.png) 
  * Install
    -  [WAMPServer](http://wampserver.com)
    -  [composer](https://getcomposer.org/download/)
    - `composer create-project cmrweb/cmrframework:dev-master nom_du_projet` 

  * Usage
    - `cd nom_du_projet`
    - `cmr` | `./cmr`
    - cmr `help`
    - cmr `start`
  ![init](https://cmrweb.fr/asset/img/init.png)
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
 
 ![exemple](https://cmrweb.fr/asset/img/cli2.png)
 ![exempleRender](https://cmrweb.fr/asset/img/cliRender.png)

 [docs pdf](https://docs.google.com/presentation/d/1FP2pDqd5z5KtJ_tku4P9MljjPUj33xVLkF9VqpDlFII/edit?usp=sharing)

