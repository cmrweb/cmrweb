<?php
if (empty($argv[1])||in_array($argv[1], array('-help', '-h', 'help','h', '','aide','-aide','a','-a'))) {
    ?>
    Utilisation :
   ================================================================================================================================
    Aide                            | cmr | -help|-h|-aide|-a|help|h|aide|a                                                       
    Generer un composant            | cmr | -generate|-gen|generate|gen|g <table> <nom-type-valeur> <nom-type-valeur-table.field> 
    Generer le module utilisateur   | cmr | -module|-mod|module|mod <-user|-u|user|u>                                                               
    Demarrer server Wamp            | cmr | -start|-serve|-s|start|serve|s <project-name>                                         
   ================================================================================================================================                                                      
<?php
} elseif ($argc >= 1 && in_array($argv[1], array('generate','-generate','-gen','gen', '-g','g'))) {
    echo'generer le composant '.$argv[2]." ?\n";
    echo 'Entree|oui|o non|n'."\n";
    echo 'Entree pour continuer: ';
    $handle = fopen ('php://stdin','r');
    $line = fgets($handle);
    if(preg_match('/non|n/',trim($line))){
        echo 'Annulé!';
        exit;
    }else if(preg_match('/oui|o|/',trim($line))){
        require_once "generator.dev.php";
    }

} elseif ($argc != 3 && in_array($argv[1], array("-serve","-start","-s","start","s","serve"))) {
    echo 'Entree|oui|o non|n'."\n";
    echo 'Demmarer le server local ?';
    $handle = fopen ('php://stdin','r');
    $line = fgets($handle);
    if(preg_match('/non|n/',trim($line))){
        echo 'Annulé!';
        exit;
    }else if(preg_match('/oui|o|/',trim($line))){
        echo "http://localhost/{$argv[2]}";
    }
} elseif (!empty($argv[2])&&in_array($argv[1], array("module","-module","mod","-mod"))) {
    if(in_array($argv[2], array("user","-user","u","-u"))){
        echo 'Entree|oui|o non|n'."\n";
        echo 'Generer le module Utilisateur ?';
        $handle = fopen ('php://stdin','r');
        $line = fgets($handle);
        if(preg_match('/non|n/',trim($line))){
            echo 'Annulé!';
            exit;
        }else if(preg_match('/oui|o|/',trim($line))){
            require_once "user.module.php";
        }
    }else{
        echo "module inconnu";
    }
    
} else {
    echo "Commande inconnue essayer : -help";
}
?>