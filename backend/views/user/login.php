<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <script type="text/javascript">
        var base_url = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
    </script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery.validate.min.js"></script>
    <script>
        var baseUrl = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
    </script>
</head>
<body>
<header id="header"><!-- <a href="#side_menu" id="navSideMenu">Side Menu</a> -->
    <h1 class="titlePage">
        <?php echo isset(Yii::$app->params['titlePage']) ? Yii::$app->params['titlePage'] : ''; ?>
    </h1>

</header>
<main id="contents">
    <section class="readme">
        <p>SSID、パスワードを入力して、「ログイン」ボタンを押してください。</p>
    </section>
    <div class="container">
        <?php
        if(Yii::$app->session->hasFlash('success_logout'))
        {
            echo Yii::$app->session->get('success_logout');
        }
        ?>
        <?php
        if(Yii::$app->session->hasFlash('error'))
        {
            ?>
            <div class="alert alert-warning">
                <?php
                echo Yii::$app->session->getFlash('error');
                ?>
            </div>
        <?php
        }
        ?>
        <?php
        $form = ActiveForm::begin([
            'id' => 'frmLogin',
            'options' => ['name' => 'frmLogin'],
        ])
        ?>
        <div class="frmContent">
            <div class="row">
                <div class="cell bgGray frmLabel">
                    <label for="ssid">SSID</label>
                </div>
                <div class="cell bgGrayTrans">
                    <?= Html::input('text', 'ssid', Yii::$app->request->post('ssid'), ['class' => 'borderGreen borderRadius','id' => 'form-ssid']) ?>
                </div>
            </div>

            <div class="row">
                <div class="cell bgGray frmLabel">
                    <label for="password">バスワード</label>
                </div>
                <div class="cell bgGrayTrans">
                    <?= Html::input('password', 'password', '', ['class' => 'borderGreen borderRadius', 'id' => 'form-password']) ?>
                </div>
            </div>

            <div class="row">
                <div class="cell"></div>
                <div class="cell">
                    <?= Html::submitButton('ログイン', ['class' => 'btnLogin bgGreen borderRadius', 'name' => 'login-button']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <script type="text/javascript" src="<?php echo \yii\helpers\BaseUrl::base(true); ?>/js/module/login.js"></script>
</main>
<footer id="footer">
    <!-- <div class="toolbar"><a href="#" class="btnBack">戻る</a></div> -->
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
