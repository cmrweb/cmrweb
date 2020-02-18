<?php
$argLower = strtolower($argv[2]);
$argUc = ucfirst($argv[2]);
$controller = "<?php\n
/*
Partie SQL
    *supprimer le code ci dessous apres le lancement de la page
*/\n
\$db = new DB;
\$query=\"CREATE TABLE IF NOT EXISTS {$argLower}
(
    id INT PRIMARY KEY AUTO_INCREMENT,\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case "password":
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` varchar(255) NOT NULL,\n";
            }
            break;
        case "pwd":
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` varchar(255) NOT NULL,\n";
            }
            break;
        case "char":
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` varchar(255) NOT NULL,\n";
            }
            break;
        case "varchar":
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` varchar(255) NOT NULL,\n";
            }
            break;
        case "file":
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` varchar(255) NOT NULL,\n";
            }
            break;
        case "image":
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` varchar({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` varchar(255) NOT NULL,\n";
            }
            break;
        default:
            if (isset($field[2]) && !isset($field[3])) {
                $controller .= "`{$field[0]}` {$field[1]}({$field[2]}) NOT NULL,\n";
            } elseif (isset($field[2]) && isset($field[3])) {
                $foreignKey = preg_replace("/\./", "(", $field[3]) . ")";
                $controller .= "`{$field[0]}` {$field[1]}({$field[2]}) NOT NULL,FOREIGN KEY (`{$field[0]}`) REFERENCES {$foreignKey},\n";
            } else {
                $controller .= "`{$field[0]}` {$field[1]} NOT NULL,\n";
            }
            break;
    }
}
$controller = substr($controller, 0, -2);
$controller .= ")\";\n
\$req=\$db->pdo->prepare(\$query);\n
\$req->execute();\n
/*
* READ
*/
\${$argv[2]}=new {$argUc}();
//dump(\${$argv[2]}->getData());
/*
* CREATE
*/
if (isset(\$_POST['send'])) {\n
    if(";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "";
            break;
        case 'image':
            $controller .= "";
            break;
        default:
            $controller .= "!empty(\$_POST[\"{$field[0]}\"]) &&";
            break;
    }
}
$controller = substr($controller, 0, -2);
$controller .= "){\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "if (!empty(\$_FILES[\"{$field[0]}\"][\"size\"])) {
                \$fileDbName = uploadImg(\$_FILES[\"{$field[0]}\"]);
                if (move_uploaded_file(\$_FILES[\"{$field[0]}\"][\"tmp_name\"], \"..\" . ROOT_DIR . IMG_DIR.\"upload/\" . \$fileDbName)) {";
            break;
        case 'image':
            $controller .= "if (!empty(\$_FILES[\"{$field[0]}\"][\"size\"])) {
                \$fileDbName = uploadImg(\$_FILES[\"{$field[0]}\"]);
                if (move_uploaded_file(\$_FILES[\"{$field[0]}\"][\"tmp_name\"], \"..\" . ROOT_DIR . IMG_DIR.\"upload/\" . \$fileDbName)) {";
            break;
        default:
            $controller .= "";
            break;
    }
}
$controller .= "\${$argv[2]}->setData([\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "\n\"{$field[0]}\" => \"\$fileDbName\",\n";
            break;
        case 'image':
            $controller .= "\n\"{$field[0]}\" => \"\$fileDbName\",\n";
            break;
        case 'password':
            $controller .= "\n\"{$field[0]}\" => password_hash(\$_POST['{$field[0]}'],PASSWORD_BCRYPT),\n";
            break;
        case 'pwd':
            $controller .= "\n\"{$field[0]}\" => password_hash(\$_POST['{$field[0]}'],PASSWORD_BCRYPT),\n";
            break;
        default:
            $controller .= "\n\"{$field[0]}\" => \$_POST['{$field[0]}'],\n";
            break;
    }
}
$controller = substr($controller, 0, -2);
$controller .= "\n]);\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "}}";
            break;
        case 'image':
            $controller .= "}}";
            break;
        default:
            $controller .= "";
            break;
    }
}
$controller.="header(\"Location: $argLower\");
}
}
/*
* UPDATE
*/
if (isset(\$_POST['update'])) {    
    if(";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "";
            break;
        case 'image':
            $controller .= "";
            break;
        default:
            $controller .= "!empty(\$_POST[\"{$field[0]}\"]) &&";
            break;
    }
}
$controller = substr($controller, 0, -2);
$controller .= "){\n";
    for ($i = 3; $i < count($argv); $i++) {
        $field = implode("-", explode(" ", $argv[$i]));
        $field = explode("-", $field);
        switch ($field[1]) {
            case 'file':
                $controller .= "if (!empty(\$_FILES[\"{$field[0]}\"][\"size\"])) {
                    \$fileDbName = uploadImg(\$_FILES[\"{$field[0]}\"]);
                    if (move_uploaded_file(\$_FILES[\"{$field[0]}\"][\"tmp_name\"], \"..\" . ROOT_DIR . IMG_DIR.\"upload/\" . \$fileDbName)) {";
                break;
            case 'image':
                $controller .= "if (!empty(\$_FILES[\"{$field[0]}\"][\"size\"])) {
                    \$fileDbName = uploadImg(\$_FILES[\"{$field[0]}\"]);
                    if (move_uploaded_file(\$_FILES[\"{$field[0]}\"][\"tmp_name\"], \"..\" . ROOT_DIR . IMG_DIR.\"upload/\" . \$fileDbName)) {";
                break;
            default:
                $controller .= "";
                break;
        }
    }
    $controller .= "\${$argv[2]}->update([\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "\n\"{$field[0]}\" => \"\$fileDbName\",\n";
            break;
        case 'image':
            $controller .= "\n\"{$field[0]}\" => \"\$fileDbName\",\n";
            break;
        case 'password':
            $controller .= "\n\"{$field[0]}\" => password_hash(\$_POST['{$field[0]}'],PASSWORD_BCRYPT),\n";
            break;
        case 'pwd':
            $controller .= "\n\"{$field[0]}\" => password_hash(\$_POST['{$field[0]}'],PASSWORD_BCRYPT),\n";
            break;
        default:
            $controller .= "\n\"{$field[0]}\" => \$_POST['{$field[0]}'],\n";
            break;
    }
}
$controller = substr($controller, 0, -2);

$controller .= "\n],\n\"id=\".\$_POST['id']);\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case 'file':
            $controller .= "}}";
            break;
        case 'image':
            $controller .= "}}";
            break;
        default:
            $controller .= "";
            break;
    }
}
$controller.="header(\"Location: $argLower\");
}
}
/*
* DELETE
*/
if (isset(\$_POST['delete'])) {\n
    \${$argv[2]}->delete(\$_POST['id']);
    header(\"Location: $argLower\");
}
?>";

$pathctrl = '../../web/pages/controller/';
$controllerFile = $pathctrl . "c_" . $argLower . '.php';
file_put_contents($controllerFile, $controller);

/**
 *  GENERATE VUE
 */

$vue = "
<!-- Ajouter $argLower à l'url. -->
<link rel='stylesheet' href=\"<?= ROOT_DIR . PAGES_DIR ?>style/{$argLower}.css\">
<form method='post' class='large primary'  enctype=\"multipart/form-data\">\n
    <h1>Create</h1>\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case "file":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"file\" class='input' name=\"{$field[0]}\"  id=\"{$field[0]}\">\n</div>\n";
            break;
        case "image":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"file\" class='input' name=\"{$field[0]}\"  id=\"{$field[0]}\">\n</div>\n";
            break;
        case "password":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"password\" class='input passSecure' name=\"{$field[0]}\"  id=\"{$field[0]}\">\n</div>\n";
            break;
        case "pwd":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"password\" class='input passSecure' name=\"{$field[0]}\"  id=\"{$field[0]}\">\n</div>\n";
            break;
        case "char":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"text\" class='input' name=\"{$field[0]}\"  id=\"{$field[0]}\">\n</div>\n";
            break;
        case "varchar":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"text\" class='input' name=\"{$field[0]}\"  id=\"{$field[0]}\">\n</div>\n";
            break;
        case "int":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"number\" class='input' name=\"{$field[0]}\" id=\"{$field[0]}\">\n</div>\n";
            break;
        case "date":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"date\" class='input' name=\"{$field[0]}\" id=\"{$field[0]}\">\n</div>\n";
            break;
        case "text":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<textarea rows=\"5\" class='input' name=\"{$field[0]}\" id\"{$field[0]}\"></textarea>\n</div>\n";
            break;
    }
}
$vue .= "<button type='submit' class='success center' name='send'>envoyer</button>
    </form>
<?php if(\${$argv[2]}->getData()): ?>
    <h1>Read Update Delete</h1>
<?php  foreach (\${$argv[2]}->getData() as \$key => \$value) : ?>
    <form method='post' class='small primary'  enctype=\"multipart/form-data\">
            <input type=\"hidden\" name=\"id\" label=\"\" class=\"\" placeholder=\"<?=\$value['id']?>\"  value=\"<?=\$value['id']?>\">\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    switch ($field[1]) {
        case "file":
            $vue .= "<div class='form'><img src=\"<?=ROOT_DIR.IMG_DIR.'upload/'.\$value['{$field[0]}']?>\" width='360' height='250'/>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"file\" name=\"{$field[0]}\"  id=\"{$field[0]}\" class=\"input\" > \n</div>\n";
            break;
        case "image":
            $vue .= "<div class='form'><img src=\"<?=ROOT_DIR.IMG_DIR.'upload/'.\$value['{$field[0]}']?>\" width='360' height='250'/>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"file\" name=\"{$field[0]}\"  id=\"{$field[0]}\" class=\"input\" > \n</div>\n";
            break;
        case "password":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"password\" name=\"{$field[0]}\"  id=\"{$field[0]}\" class=\"input\" placeholder=\"<?=\$value['{$field[0]}']?>\" value=\"<?=\$value['{$field[0]}']?>\"> \n</div>\n";
            break;
        case "pwd":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"password\" name=\"{$field[0]}\"  id=\"{$field[0]}\" class=\"input\" placeholder=\"<?=\$value['{$field[0]}']?>\" value=\"<?=\$value['{$field[0]}']?>\"> \n</div>\n";
            break;
        case "char":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"text\" name=\"{$field[0]}\"  id=\"{$field[0]}\" class=\"input\" placeholder=\"<?=\$value['{$field[0]}']?>\" value=\"<?=\$value['{$field[0]}']?>\"> \n</div>\n";
            break;
        case "varchar":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"text\" name=\"{$field[0]}\"  id=\"{$field[0]}\" class=\"input\" placeholder=\"<?=\$value['{$field[0]}']?>\" value=\"<?=\$value['{$field[0]}']?>\"> \n</div>\n";
            break;
        case "int":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"number\" name=\"{$field[0]}\" id=\"{$field[0]}\" class=\"input\" placeholder=\"<?=\$value['{$field[0]}']?>\" value=\"<?=\$value['{$field[0]}']?>\"> \n</div>\n";
            break;
        case "date":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<input type=\"date\"name=\"{$field[0]}\" class=\"input\" id=\"{$field[0]}\" placeholder=\"<?=\$value['{$field[0]}']?>\" value=\"<?=\$value['{$field[0]}']?>\"> \n</div>\n";
            break;
        case "text":
            $vue .= "<div class='form'>\n<label for='{$field[0]}'>{$field[0]}</label>\n<textarea rows=\"5\" name=\"{$field[0]}\" class=\"input\" id=\"{$field[0]}\"><?=\$value['{$field[0]}']?></textarea>\n</div>\n";
            break;
    }
}
$vue .= "<button type='submit' class='success center' name='update'>mettre a jour</button>
        <button type='delete' class='danger center'  name='delete'>supprimer</button>
        </form>
<?php endforeach;
endif;
";
$pathvue = '../../web/pages/';
$vueFile = $pathvue . $argLower . '.php';
file_put_contents($vueFile, $vue);

$pathcss = '../../web/pages/style/';
$cssFile = $pathcss . $argLower . '.css';
file_put_contents($cssFile, "");
/**
 * GENERATE CLASS
 */
$class = "<?php
class {$argUc}
{\n    
    private \$pdo;
    private \$data;
    private \$id;\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    $class .= "private \${$field[0]};\n";
}
$class .= "
    function __construct(\$bool = NULL)
    {
        \$this->pdo = new DB;
        \$this->pdo->select('*', '{$argLower}', \$bool);
        foreach (\$this->pdo->result as \$value) {
            \$this->data[\$value['id']] = [
                'id' => \$value['id'],\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    $class .= "'{$field[0]}'=>\$value['{$field[0]}'],\n";
}
$class .= "  ];\n";
$class .= " \$this->id[] = \$value['id'];\n";
for ($i = 3; $i < count($argv); $i++) {
    $field = implode("-", explode(" ", $argv[$i]));
    $field = explode("-", $field);
    $class .= "\$this->{$field[0]}[] = \$value['{$field[0]}'];\n";
}
$class .= "
        }
        return \$this->data;
    }
    public function getData(): ?array
    {
        return \$this->data;
    }
    public function setData(\$data)
    {
        \$this->pdo->insert('{$argLower}',\$data);
    }
    public function update(\$data,\$id)
    {
        \$this->pdo->update('{$argLower}',\$data,\$id);
    }
    public function delete(\$data)
    {
        \$this->pdo->delete('{$argLower}',\"id=\".\$data);
    }
}";
// echo $class;
$pathClass = '../../web/Entity/';
$classFile = $pathClass . $argUc . '.php';
file_put_contents($classFile, $class);

/**
 *  GENERATE ROUTE
 */
preg_match("/\[[\W|\w|\s]*\]/", file_get_contents("../../web/module/route.php"), $oldRoute);
$route = substr($oldRoute[0], 0, -1) . ",'{$argLower}'=>'{$argLower}'\n]";
$routeFinal = preg_replace("/\[[\W|\w|\s]*\]/", $route, file_get_contents("../../web/module/route.php"));
file_put_contents("../../web/module/route.php", $routeFinal);
$path = preg_replace("/[\w|\W]*www\W|\Wlib\Wcli/", "", __DIR__);
echo "Generation des fichiers : \n->" . $pathClass . $argUc . ".php \n-> " . $pathvue . $argLower . ".php \n-> " . $pathctrl . "c_" . $argLower . ".php \n-> " . $pathcss . $argLower . ".css \nRoute http://localhost/$path/$argLower ajouter";
