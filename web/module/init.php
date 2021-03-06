<?php
use cmrweb\DB;
$projectName = preg_replace("/\//","",$_ENV['ROOT_PATH']);
$dbHOST = $_ENV['DB_HOST'];
$dbNAME = $_ENV['DB_NAME'];
$dbUSER = $_ENV['DB_USER'];
$dbPASS = $_ENV['DB_PASS'];
// $envContent = "APP_ENV=\"dev\"\nDB_HOST=\"{$dbHOST}\"\nDB_NAME=\"{$dbNAME}\"\nDB_USER=\"{$dbUSER}\"\nDB_PASS=\"{$dbPASS}\"\nROOT_PATH=\"/{$projectName}\"";
// //dump($envContent);
// file_put_contents(".env", $envContent);
if (isset($_POST['send'])) {
  //réecrire .env
  if (!empty($_POST['dbHost']) && !empty($_POST['dbName']) && !empty($_POST['dbUser']) && !empty($_POST['username']) && !empty($_POST['pwd'])) {
    $user = $_POST['username'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
    $dbHOST = $_POST['dbHost'];
    $dbNAME = $_POST['dbName'];
    $dbUSER = $_POST['dbUser'];
    $dbPASS = $_POST['dbPwd'];
    $envContent = "APP_ENV=\"dev\"\nDB_HOST=\"{$dbHOST}\"\nDB_NAME=\"{$dbNAME}\"\nDB_USER=\"{$dbUSER}\"\nDB_PASS=\"{$dbPASS}\"\nROOT_PATH=\"/{$projectName}\"";
    //dump($envContent);
    file_put_contents(".env", $envContent);

    $db = new DB($dbNAME);
        //init required tables
    $tableUser = $db->pdo->prepare("DROP TABLE IF EXISTS `user`;
    CREATE TABLE IF NOT EXISTS `user` (

      `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
      `email` varchar(30) NOT NULL,
      `password` varchar(255) NOT NULL,
      `admin_lvl` int(11) DEFAULT NULL,
      `token` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    INSERT INTO `user` (`email`, `password`, `admin_lvl`,`token`) 
    VALUES('{$user}','{$pwd}',1,null);

    DROP TABLE IF EXISTS `post`;
    CREATE TABLE IF NOT EXISTS `post` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `parent_id` int(11) DEFAULT NULL,
      `user_id` int(11) DEFAULT NULL,
      `title` varchar(255) DEFAULT NULL,
      `post` text,
      `img` varchar(50) DEFAULT NULL,
      `category` int(11) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    DROP TABLE IF EXISTS `cmr_follow`;
    CREATE TABLE IF NOT EXISTS `cmr_follow` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `follow_id` int(11) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    DROP TABLE IF EXISTS `profil`;
    CREATE TABLE IF NOT EXISTS `profil` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `nom` varchar(255) NOT NULL,
      `prenom` varchar(255) NOT NULL,
      `age` int(11) NOT NULL,
      `adresse` varchar(255) NOT NULL,
      `cp` int(11) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

    DROP TABLE IF EXISTS `chat`;
    CREATE TABLE IF NOT EXISTS `chat` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `nom` varchar(100) NOT NULL,
      `message` text NOT NULL,
      `date` datetime NOT NULL DEFAULT '2019-10-03 00:00:00',
      `sendby` int(11) NOT NULL,
      `sendto` int(11) DEFAULT '0',
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    DROP TABLE IF EXISTS `online_user`;
    CREATE TABLE IF NOT EXISTS `online_user` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` text NOT NULL,
      `time` datetime DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;COMMIT;");
    $tableUser->execute();
    //reecriture du path cli
    $cli = preg_replace("/cmrweb/", $projectName, file_get_contents("lib/cli/cmr.bat"));
    file_put_contents("lib/cli/cmr.bat", $cli);

    $module = preg_replace("/init\s\=\strue\;/", "init = false;", file_get_contents("web/includes/header.php"));
    file_put_contents("web/includes/header.php", $module);
    //reecriture des routes
    $route = preg_replace("/init/", "home", file_get_contents("web/module/route.php"));
    //dump($route);
    file_put_contents("web/module/route.php", $route);
    
    $_SESSION['message']['success'] = "Projet initialiser";
    header("Location: ./home");
  }else{
      $_SESSION['message']['danger'] = "Veuillez Remplir les champs";
      header("Location: ./");
  }
}

 require "web/module/init.manifest.php";
?>
<style>
  label {
    display: block
  }
</style>
<form method="post" class='large primary formContainer form'>
  <h1>Initialiation du projet</h1>

    <label for="dbHost">Hote de la Base de données</label>
    <input class="input" type="text" id="dbHost" name="dbHost" value="<?= $dbHOST ?>">


    <label for="dbName">Nom de la Base de données</label>
    <input class="input" type="text" id="dbName" name="dbName" value="<?= $dbNAME ?>">


    <label for="dbUser">Nom d'utilisateur de la Base de données</label>
    <input class="input" type="text" id="dbUser" name="dbUser" value="<?= $dbUSER ?>">


    <label for="dbPwd">Mot de passe de la Base de données</label>
    <input class="input" type="text" id="dbPwd" name="dbPwd" value="<?= $dbPASS ?>">


    <label for="username">Email d'utilisateur (Administrateur du site)</label>
    <input class="input mailSecure" type="email" id="username" name="username">


    <label for="pwd">Mot de passe</label>
    <input class="input passSecure" type="password" id="pwd" name="pwd">

  <button class="btn success large center m4" name="send">Valider</button>
</form>
