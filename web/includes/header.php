<header class="fixhead xlarge light header">
    <?php
    $dev = $_ENV['APP_ENV'] == "dev" ? true : false;

    $userModule=false;
    $init = true;

    echo $html->h(1, 'CMRWEB<span>PHP PWA</span><span>framework</span>', 'title');
    if (isset($_POST['disc'])) {
        unset($_SESSION['user']);
        header("Location: ./");
    }
    ?>
    <i class="fas fa-bars menu"></i>
    <?php
    if (empty($_SESSION['user']) && $userModule) {
        echo
            $html->code(
                'nav',
                $html->menu(
                    [
                        'Inscription' => '',
                        'Connexion' => ''
                    ],
                    'primary popupBtn'
                ),
                'nav navConn'
            );
    } elseif (!empty($_SESSION['user'])) {
        $form = $html->formOpen('', 'post') .
            $html->button('submit', 'primary navConn', '<i class="fas fa-times-circle"></i>', 'disc') .
            $html->formClose();

        echo $form;
    }
    if (!$init)
        include 'web/module/nav.php';
    ?>
    <p id="AppInstall" class="btn-gold">PWA <i class="fas fa-cloud-download-alt"></i></p>

</header>
<div class="message">
    <?php if (isset($_SESSION['message'])) message($_SESSION['message']) ?>
</div>
<main class="m4">

    <div id="bgCover" class="hide" onclick="openModal()"></div>
    <style>
        .speech {
            top: 118px;
            right: 5px;
        }
    </style>
    <div class="speech"></div>
    <script src="<?= ROOT_DIR . JS_DIR ?>cmrSpeech.js"></script>
